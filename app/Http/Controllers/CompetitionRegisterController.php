<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Registrant;
use App\Models\Transaction;
use Duitku\Api;
use Illuminate\Http\Request;
use Duitku\Config;
use Duitku\Pop;
use Exception;

class CompetitionRegisterController extends Controller
{
    public function index(Competition $competition)
    {
        $competition->update(['views' => $competition->views + 1]);
        return view('detail-competition', compact('competition'));
    }

    public function form(Competition $competition)
    {
        if (!$competition->getRegistrationStatus('is_open')) abort(404);
        if (Registrant::where('user_id', auth()->id())->exists()) {
            return redirect()->route('competition.detail', $competition)->with('error', 'You have already registered at Derrick ' . date('Y'));
        }
        return view('register-competition', compact('competition'));
    }

    public function register(Competition $competition, Request $request)
    {
        if (auth()->user()->role == 'admin') return redirect()->route('competition.detail', $competition)->with('error', 'You are not allowed to register');

        //get registration number
        $latest_registrant = Registrant::where('competition_id', $competition->id)->latest()->first();
        $queue = (int) ($latest_registrant ? explode('-', $latest_registrant->registration_number)[1] : "0000");
        $reg_no = $competition->code . '-' . str_pad($queue + 1, 4, '0', STR_PAD_LEFT);

        $request->validate([
            'team_name' => 'required',
            'phone' => 'required',
            'university' => 'required',
            'major' => 'required',
            'id_card' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'student_card' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('id_card')) {
            $request->id_card->store('public/competition/registrant/id_card');
            $id_card = $request->id_card->hashName();
        }

        if ($request->hasFile('student_card')) {
            $request->student_card->store('public/competition/registrant/student_card');
            $student_card = $request->student_card->hashName();
        }

        try {
            $registrans = $competition->registrant()->create([
                'user_id' => auth()->user()->id,
                'registration_number' => $reg_no,
                'team_name' => $request->team_name,
                'phone_number' => $request->phone,
                'university' => $request->university,
                'major' => $request->major,
                'id_card' => $id_card,
                'student_card' => $student_card,
            ]);
            return redirect(route('competition.checkout') . '?reg=' . $registrans->registration_number);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function checkout()
    {
        if (!request()->has('reg')) abort(404);
        $registrant = Registrant::where('registration_number', request('reg'))->first();
        if (!$registrant || $registrant->user_id != auth()->id()) abort(404);
        if ($registrant->isPaid()) return redirect()->route('registrant.competition');

        $duitkuConfig = new Config(env('DUITKU_MERCHANT_KEY'), env('DUITKU_MERCHANT_CODE'));
        $duitkuConfig->setSandboxMode(!env('PAYMENT_IS_PRODUCTION'));

        $nameExplode = explode(' ', $registrant->user->name);

        $customerDetail = array(
            'firstName'         => $nameExplode[0],
            'lastName'          => $nameExplode[1] ?? '',
            'email'             => $registrant->user->email,
        );

        $params = array(
            'paymentAmount'     => $registrant->competition->getCurrentPrice() + 6000,
            'merchantOrderId'   => $registrant->registration_number . '-' . date('YmdHis'),
            'productDetails'    => $registrant->competition->name,
            'customerVaName'    => $registrant->user->name,
            'email'             => $registrant->user->email,
            'itemDetails'       => array(
                [
                    'name'      => $registrant->competition->name,
                    'price'     => $registrant->competition->getCurrentPrice(),
                    'quantity'  => 1
                ], [
                    'name'      => 'Admin Fee',
                    'price'     => 6000,
                    'quantity'  => 1
                ]
            ),
            'customerDetail'    => $customerDetail,
            'callbackUrl'       => 'https://derrick.id/api/notification', // url for callback,
            'returnUrl'         => 'https://derrick.id/return', // url for redirect,
            'expiryPeriod'      => 60, // set the expired time in minutes
        );

        try {
            $responseDuitkuPop = Pop::createInvoice($params, $duitkuConfig);
            // header('Content-Type: application/json');
            // echo $responseDuitkuPop;
            $responseArray = json_decode($responseDuitkuPop, true);
            return view('checkout-competition', compact('registrant', 'responseDuitkuPop', 'responseArray'));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback()
    {
        $response = json_decode(request('callback'));
        try {
            $duitkuConfig = new Config(env('DUITKU_MERCHANT_KEY'), env('DUITKU_MERCHANT_CODE'));
            $duitkuConfig->setSandboxMode(!env('PAYMENT_IS_PRODUCTION'));

            $transactionList = Api::transactionStatus($response->merchantOrderId, $duitkuConfig);
            // header('Content-Type: application/json');
            $transaction = json_decode($transactionList);
            // dd($response, $transaction);
            if ($response->resultCode == '00' || $response->resultCode == '01') {
                $registration_number = isset($transaction->merchantOrderId) ? explode('-', $transaction->merchantOrderId)[0] . '-' . explode('-', $transaction->merchantOrderId)[1] : null;
                $registrant = Registrant::where('registration_number', $registration_number)->first();
                if ($registrant) {
                    Transaction::create([
                        'registrant_id' => $registrant->id,
                        'merchant_order_id' => $transaction->merchantOrderId,
                        'reference' => $transaction->reference,
                        'status_code' => $transaction->statusCode,
                        'status_message' => $transaction->statusMessage ?? '',
                        'amount' => $transaction->amount,
                        'fee' => $transaction->fee,
                        'payment_code' => $transaction->paymentCode ?? null,
                        'result_code' => $transaction->resultCode ?? null,
                        'response' => request('callback'),
                        'registration_batch' => $registrant->competition->getRegistrationStatus(),
                    ]);

                    return redirect(route('competition.registered', $registrant->competition) . '?order_id=' . $response->merchantOrderId . '&transaction_status=' . $transaction->statusMessage);
                }
            }

            return redirect()->route('registrant.competition');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function notification()
    {
        $apiKey = env('DUITKU_MERCHANT_KEY'); // API key anda
        $merchantCode = isset($_POST['merchantCode']) ? $_POST['merchantCode'] : null;
        $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
        $merchantOrderId = isset($_POST['merchantOrderId']) ? $_POST['merchantOrderId'] : null;
        $productDetail = isset($_POST['productDetail']) ? $_POST['productDetail'] : null;
        $additionalParam = isset($_POST['additionalParam']) ? $_POST['additionalParam'] : null;
        $paymentCode = isset($_POST['paymentCode']) ? $_POST['paymentCode'] : null;
        $resultCode = isset($_POST['resultCode']) ? $_POST['resultCode'] : null;
        $merchantUserId = isset($_POST['merchantUserId']) ? $_POST['merchantUserId'] : null;
        $reference = isset($_POST['reference']) ? $_POST['reference'] : null;
        $signature = isset($_POST['signature']) ? $_POST['signature'] : null;

        //log callback untuk debug
        file_put_contents('callback.txt', "* Callback *\r\n", FILE_APPEND | LOCK_EX);

        if (!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature)) {
            $params = $merchantCode . $amount . $merchantOrderId . $apiKey;
            $calcSignature = md5($params);

            if ($signature == $calcSignature) {
                $transaction = Transaction::where('merchant_order_id', $merchantOrderId)->first();
                if ($resultCode == "00") {
                    $transaction->update([
                        'payment_code' => $paymentCode,
                        'status_message' => 'SUCCESS',
                    ]);
                } else if ($resultCode == "01") {
                    $transaction->update([
                        'payment_code' => $paymentCode,
                        'status_message' => 'FAILED',
                    ]);
                }
                file_put_contents('callback.txt', "* Berhasil *\r\n\r\n", FILE_APPEND | LOCK_EX);
                echo "SUCCESS"; // Mohon untuk memberikan respon success
            } else {
                file_put_contents('callback.txt', "* Bad Signature *\r\n\r\n", FILE_APPEND | LOCK_EX);
                throw new Exception('Bad Signature');
            }
        } else {
            file_put_contents('callback.txt', "* Bad Parameter *\r\n\r\n", FILE_APPEND | LOCK_EX);
            throw new Exception('Bad Parameter');
        }
    }

    public function checkTransactionStatus()
    {
        if (!request()->has('order_id')) abort(400);
        try {
            $duitkuConfig = new Config(env('DUITKU_MERCHANT_KEY'), env('DUITKU_MERCHANT_CODE'));
            $duitkuConfig->setSandboxMode(!env('PAYMENT_IS_PRODUCTION'));

            $transactionList = Api::transactionStatus(request('order_id'), $duitkuConfig);
            // header('Content-Type: application/json');
            // echo $transactionList;
            // die;
            $transaction = json_decode($transactionList);
            $userTransaction = Transaction::where('merchant_order_id', $transaction->merchantOrderId)->first();
            $userTransaction->update([
                'payment_code' => $transaction->paymentCode ?? null,
                'status_message' => $transaction->statusMessage,
            ]);

            return request('redirect') ? redirect(request('redirect')) : redirect()->back();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
