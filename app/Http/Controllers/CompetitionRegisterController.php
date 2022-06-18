<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Registrant;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;

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

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $registrant->registration_number . '-' . date('YmdHis'),
                'gross_amount' => $registrant->competition->getCurrentPrice() + 6000,
            ),
            'item_details' => array([
                'id' => $registrant->competition->id,
                'price' => $registrant->competition->getCurrentPrice() + 6000,
                'quantity' => 1,
                'name' => $registrant->competition->name,
            ]),
            'customer_details' => array(
                'first_name' => $registrant->user->name,
                'last_name' => '',
                'email' => $registrant->user->email,
                'phone' => $registrant->phone_number,
            ),
        );

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } catch (\Throwable $th) {
            return $th;
        }

        return view('checkout-competition', compact('registrant', 'snapToken'));
    }

    public function callback()
    {
        $response = json_decode(request('callback'));
        if ($response->status_code == '200' || $response->status_code == '201') {
            $registration_number = isset($response->order_id) ? explode('-', $response->order_id)[0] . '-' . explode('-', $response->order_id)[1] : null;
            $registrant = Registrant::where('registration_number', $registration_number)->first();
            if ($registrant) {
                Transaction::create([
                    'registrant_id' => $registrant->id,
                    'transaction_id' => $response->transaction_id,
                    'order_id' => $response->order_id,
                    'status_code' => $response->status_code,
                    'status_message' => $response->status_message,
                    'gross_amount' => $response->gross_amount,
                    'payment_type' => $response->payment_type,
                    'transaction_time' => $response->transaction_time,
                    'transaction_status' => $response->transaction_status,
                    'fraud_status' => isset($response->fraud_status) ? $response->fraud_status : null,
                    'pdf_url' => isset($response->pdf_url) ? $response->pdf_url : null,
                    'response' => request('callback'),
                    'registration_batch' => $registrant->competition->getRegistrationStatus(),
                    'registration_price' => $registrant->competition->getCurrentPrice(),
                ]);

                //return to thank you page
                return redirect(route('competition.registered', $registrant->competition) . '?order_id=' . $response->order_id . '&transaction_status=' . $response->transaction_status);
            }
        }

        // return to registrant transaction page
        return redirect()->route('registrant.competition');
    }

    public function notification()
    {
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $message = "Transaction order_id: " . $order_id . " is challenged by FDS";
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $message = "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $message = "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $message = "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }

        $local = Transaction::where('order_id', $order_id)->first();
        $local->update([
            'transaction_status' => $transaction,
            'status_message' => $message,
            'fraud_status' => $fraud ?? null,
            'settlement_time' => $notif->settlement_time ?? null,
            'notification' => request()->getContent(),
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
