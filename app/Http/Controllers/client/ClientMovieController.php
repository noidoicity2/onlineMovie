<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;

class ClientMovieController extends Controller
{
    //
    protected  $movieRepository;
    protected $category ;
    protected $episodeRepository;
    public function __construct(MovieRepositoryInterface $movieRepository, EpisodeRepositoryInterface $episodeRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->episodeRepository = $episodeRepository;
        $this->category = Category::OnLyName()->get();
    }

    public function Index() {

//        return view('client.page.movie.home');
    }
    public function GetMovieBySlug($slug =null , $id = null) {

        $movie  = $this->movieRepository->get($id);
        $episodes = $movie->episodes;
//        return $episodes;

//        return ($movie);

        return view('client.page.movie.detail' , [
            'movie'=>$movie,
            'episode' => $episodes,
            'categories'=>$this->category,

        ]);
    }
    public function Watch($slug =null , $id = null) {
        $movie = $this->movieRepository->get($id);

//        return $movie->episodes;

        return view ('client.page.movie.watch' , [
           'movie' => $movie ,
            'categories'=>$this->category,
        ]);

    }
    public function testJw() {
        return view('client.page.testJw', [
            'categories'=>$this->category,
        ]);

    }

}
