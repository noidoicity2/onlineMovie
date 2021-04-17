<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

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

        return view('admin.page.dashBoard.viewDashBoard',[
            'totalRevenue' => $totalRevenue,
            'totalMovie'    => $totalMovie,
            'totalUser'     => $totalUser,
            'totalCategory' => $totalCategory,
        ] );
    }
}
