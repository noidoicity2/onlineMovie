<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
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
    public function GetMovieBySlug($slug =null , $id = null) {
        $movie  = Movie::find($id);
        $category = Category::OnLyName()->get();
        return view('client.page.movie.detail' , [
            'movie'=>$movie,
            'categories'=>$category,
        ]);
    }

}
