<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransactionController extends Controller
{
    public function index()
    {
        $this->authorize('isRegistrant');
        $registrant = Registrant::where('user_id', auth()->id())->first();
        if (!$registrant) return redirect()->route('registrant.competition');
        if ($registrant->transactions()->count() == 0) return redirect(route('competition.checkout') . '?reg=' . $registrant->registration_number);

        $transactions = $registrant->transactions()->latest();
        $current_transaction = $registrant->latestPayment();
        $other_transaction = $transactions->count() > 1 ? $transactions->where('id', '!=', $current_transaction->id)->get() : null;
        return view('registrant.transaction.index', compact('registrant', 'current_transaction', 'other_transaction'));
    }

    public function ticket($id = null)
    {
        $register = Registrant::where('user_id', $id ?? auth()->id())->first();
        if (!$register) abort(404);
        $latest_transaction = $register->transactions()->latest()->first();
        $qr = QrCode::size(60)->generate(route('search') . '?q=' . $register->registration_number);
        try {
            $pdf = Pdf::loadView('registrant.ticket.index', compact('register', 'latest_transaction', 'qr'));
            return $pdf->download('Ticket (' . $register->team_name . ').pdf');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
