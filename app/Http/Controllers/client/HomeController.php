<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
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
        $category = Category::OnLyName()->get();
        $new_movies = Movie::NewestMovie()->limit(5)->get();
//        return  $new_movies;
        return view('client.page.movie.home', [
            'categories'  => $category,
            'new_movies'   => $new_movies,
        ] );
    }
}
