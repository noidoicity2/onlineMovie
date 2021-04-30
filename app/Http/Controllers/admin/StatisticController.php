<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    //
    public function TransactionStatistic(Request  $request) {

        if(isset($request->from_date) && isset($request->to_date)) {
            $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date);
            $toDate =  Carbon::createFromFormat('Y-m-d', $request->to_date);
        }
        else{
            $fromDate = "";
            $toDate = "";
        }

        $data = [];
        $transactions = Transaction::with('user', 'membership' )->whereBetween('created_at' , [$fromDate , $toDate])->get();

        $successTrans=$transactions->where('status' , '=','success')->groupBy('membership.name' )->map(function ($item) {
                return $item->sum('total_amount');
        })->toArray();
        foreach ($successTrans as $key => $value) {
                array_push($data ,[
                    'label' => $key,
                    'y' => $value,
                ] );
        }

        $success_count = $transactions->where('status' , '=','success')->count();

        $unsuccessful_count = $transactions->where('status' , '=','unsuccessfully')->count();

        $total_revenue = $transactions->where('status' , '=','success')->sum('total_amount');
//        return  $transactions;
            return view('admin.page.statistic.transaction', [
                'transactions' => $transactions ,
                'success_count'=> $success_count,
                'total_revenue' => $total_revenue,
                'unsuccessful_count' => $unsuccessful_count,
                'successTrans' => $data
            ]);
        }





    public function MovieStatistic() {

    }

}
