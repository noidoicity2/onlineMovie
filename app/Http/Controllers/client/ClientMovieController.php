<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;

class ClientMovieController extends Controller
{
    //
    protected  $movieRepository;
    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function Index() {

//        return view('client.page.movie.home');
    }

}
