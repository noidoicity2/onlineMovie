<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    //
    protected  $movieRepository;
    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function home() {
        $category = Category::OnLyName();
        return view('client.page.movie.home' , ['']);
    }
}
