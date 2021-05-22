<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DasboardController extends Controller
{
    //
    protected $movieRepository;
    protected $transactionRepository;
    protected $userRepository;
    protected $categoryRepository;
    public function __construct(MovieRepositoryInterface $movieRepository,
                                TransactionRepositoryInterface  $transactionRepository,
                                UserRepositoryInterface $userRepository,
                                CategoryRepository  $categoryRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function  Index() {

        $totalRevenue = $this->transactionRepository->getTotalRevenue();
        $totalMovie = $this->movieRepository->getTotalMovie();
        $totalUser = $this->userRepository->getTotalUser();
        $totalCategory = $this->categoryRepository->getTotalCategory();

        $fromDate = now()->subDays(30);
        $toDate =  now();

//        $tmp_date = clone $fromDate;
//
//        $all_dates = array();
//        while ($tmp_date->lte($toDate)){
//            $all_dates[] = $tmp_date->toDateString();
//
//            $tmp_date->addDay();
//        }
////        return $all_dates;
//        $all_chart_data = $this->DatesToChartData($all_dates);
//
//
        $chart_data = [];
        $successTrans = Transaction::select(DB::raw('SUM(total_amount) as sum'))
            ->addSelect('transaction.created_at')
            ->where('status' , 'success')
            ->whereBetween('created_at' , [$fromDate , $toDate])
            ->groupByRaw('Date(created_at)')->get();

        foreach ($successTrans as $item) {
            array_push($chart_data ,[
                'label' =>Carbon::parse($item->created_at)->format('Y-m-d') ,
                'y' => $item->sum,
            ] );
        }
//        $chart_datas = array_replace($all_chart_data, $chart_data );
//        return $all_charts;

        return view('admin.page.dashBoard.viewDashBoard',[
            'totalRevenue' => $totalRevenue,
            'totalMovie'    => $totalMovie,
            'totalUser'     => $totalUser,
            'totalCategory' => $totalCategory,
            'chart_data' => $chart_data,
        ] );
    }
    private  function DatesToChartData ($date) {
        $all_data = [];
        foreach ($date as $values ) {
            array_push($all_data ,[
//                'label' =>Carbon::parse($values)->format('Y-m-d') ,
//                'y' => 0,
                Carbon::parse($values)->format('Y-m-d') => 0 ,
            ] );
        }
        return $all_data;
    }
}
