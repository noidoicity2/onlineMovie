<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    public function History() {
        $transactions = Transaction::paginate(5);

        return view('client.page.transaction.transactionHistory' , [
            "transactions" => $transactions,
        ]);
    }

}
