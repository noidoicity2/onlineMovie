<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\MovieView;
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
            $fromDate = now()->subDays(30);
            $toDate =  now();
        }

        $data = [];
        $transactions = Transaction::with('user', 'membership' )->whereBetween('created_at' , [$fromDate , $toDate])->get();

        $successTrans=$transactions->where('status' , '=','success')->groupBy('membership.name' )->map(function ($item) {
                return $item->sum('total_amount');
        })->toArray();



//        return  $successTrans;
        foreach ($successTrans as $key => $value) {
            if($key == "" ) {
                array_push($data ,[
                    'label' => "Deleted membership",
                    'y' => $value,
                ] );
            }
            else {
                array_push($data ,[
                    'label' => $key,
                    'y' => $value,
                ] );
            }

        }

        $success_count = $transactions->where('status' , '=','success')->count();

        $unsuccessful_count = $transactions->where('status' , '=','unsuccessfully')->count();

        $total_revenue = $transactions->where('status' , '=','success')->sum('total_amount');
//        return  $transactions;
            return view('admin.page.statistic.transaction', [
                'from_date' => $fromDate,
                'to_date' =>$toDate,
                'transactions' => $transactions ,
                'success_count'=> $success_count,
                'total_revenue' => $total_revenue,
                'unsuccessful_count' => $unsuccessful_count,
                'successTrans' => $data
            ]);
        }





    public function MovieStatistic(Request $request) {
        if(isset($request->from_date) && isset($request->to_date)) {
            $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date);
            $toDate =  Carbon::createFromFormat('Y-m-d', $request->to_date);

        }
        else{
            $fromDate = now()->subDays(30);
            $toDate =  now();
        }
        $tmp_date = clone $fromDate;

        $all_dates = array();
        while ($tmp_date->lte($toDate)){
            $all_dates[] = $tmp_date->toDateString();

            $tmp_date->addDay();
        }

//        return $fromDate;
//        return $all_dates;
//        return $all_dates;
        $movie_view = MovieView::select(DB::raw('count(*) as view_count , created_at'))->whereIn('created_at' , $all_dates)->groupBy('created_at')->orderBy('created_at','asc')->get();
        $total_view = MovieView::count();
        $group = $movie_view;
//        return  $movie_view;
        $chart_data = [];
        $all_data = $this->DatesToChartData($all_dates);
//        foreach ($all_dates as $values ) {
//            array_push($all_data ,[
//                'label' => $values,
//                'y' => 0,
//            ] );
//        }
//        return  $all_data;
        foreach ($movie_view as $item) {
            array_push($chart_data ,[
                'label' => $item->created_at,
                'y' => $item->view_count,
            ] );
        }
        $all_chart_data = array_merge($all_data , $chart_data);
//        return $movie_view;
        $movie = Movie::withCount('favoriteMovies')
            ->withCount('movieViews')
            ->get();
//        return $movie;
        return view('admin.page.statistic.movie',[
            'movies' => $movie,
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'chart_data' => $all_chart_data,
            'total_view' => $total_view,
        ]);
    }
    public function MovieStatisticDetail(Request $request , $id =null) {
        if(isset($request->from_date) && isset($request->to_date)) {
            $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date);
            $toDate =  Carbon::createFromFormat('Y-m-d', $request->to_date);

        }
        else{
            $fromDate = now()->subDays(7);
            $toDate =  now();
        }
        $tmp_date = clone $fromDate;
        $movie = Movie::find($id);
//        return $movie;

        $all_dates = array();
        while ($tmp_date->lte($toDate)){
            $all_dates[] = $tmp_date->toDateString();

            $tmp_date->addDay();
        }
//        return $all_dates;
        $all_chart_data = $this->DatesToChartData($all_dates);

        $movie_view = MovieView::select(DB::raw('count(*) as view_count , created_at'))
            ->whereIn('created_at' , $all_dates)->groupBy('created_at')
            ->where('movie_id' , $id)
            ->orderBy('created_at','asc')->get();
        $group = $movie_view;
//        return  $movie_view;
        $chart_data = [];
        foreach ($movie_view as $item) {
            array_push($chart_data ,[
                'label' => $item->created_at,
                'y' => $item->view_count,
            ] );
        }
        $chart_data = array_merge($all_chart_data, $chart_data);

//
//        $movie = Movie::withCount('favoriteMovies')->get();
//
        return view('admin.page.statistic.movieStatisticDetail',[
            'movies' => $movie,
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'chart_data' => $chart_data,
            'movie' => $movie
        ]);

    }

    private  function DatesToChartData ($date) {
        $all_data = [];
        foreach ($date as $values ) {
            array_push($all_data ,[
                'label' => $values,
                'y' => 0,
            ] );
        }
        return $all_data;
    }

}
