<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search()
    {
        $this->authorize('isAdmin');
        $registers = Registrant::where('registration_number', request('q'))->first();
        $transactions = $registers->transactions()->latest() ?? [];
        $current_transaction = $registers->latestPayment() ?? [];
        $other_transaction = $transactions->count() > 1 ? $transactions->where('id', '!=', $current_transaction->id)->get() : null;
        return view('admin.search.index', compact('registers', 'current_transaction', 'other_transaction'));
    }
}
