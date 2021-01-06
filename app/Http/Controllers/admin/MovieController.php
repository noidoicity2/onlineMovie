<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;


use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    //
    protected  $movieRepository;
    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getAll() {
        return $this->movieRepository->all();
//        return "dasd";
    }
}
