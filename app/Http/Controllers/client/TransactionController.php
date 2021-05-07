<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //
    public function History() {
        $transactions = Transaction::with('membership')->where('user_id' , Auth::id())->paginate(5);
//        return $transactions;
        return view('client.page.transaction.transactionHistory' , [
            "transactions" => $transactions,
        ]);
    }

}
