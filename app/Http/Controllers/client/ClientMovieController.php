<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;

class ClientMovieController extends Controller
{
    //
    protected  $movieRepository;
    protected  $countryRepository;
    protected $episodeRepository;

    protected $categories ;
    protected $countries;

    public function __construct(MovieRepositoryInterface $movieRepository,
                                EpisodeRepositoryInterface $episodeRepository ,
                                CountryRepositoryInterface $countryRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->episodeRepository = $episodeRepository;
        $this->countryRepository =$countryRepository;

//        $this->categories = Category::OnLyName()->get()->take(10);
//        $this->countries = $this->countryRepository->getCountryForSelect()->take(5)->get();
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
            'categories'=>$this->categories,
            'countries'   => $this->countries,

        ]);
    }
    public function Watch($slug =null , $id = null) {
        $movie = $this->movieRepository->get($id);

//        return $movie->episodes;

        return view ('client.page.movie.watch' , [
           'movie' => $movie ,
            'categories'=>$this->categories,
            'countries'   => $this->countries,
        ]);

    }
    public function testJw() {
        return view('client.page.testJw', [
            'categories'=>$this->category,
        ]);

    }

    public function MovieSeries($id) {
        $movies = Movie::where('is_movie_series',1)->paginate(5)->get();

    }

    public function GetAllContries() {
//        retu
        $allCountry = $this->countryRepository->Paginate(30);

        return view('client.page.movie.listMovieBy' ,[
            'categories'  => $this->categories,
            'countries'   => $this->countries,
            'listCountries'=>$allCountry,

        ]);
    }

    public function GetMovieByCountry($slug=null,$id=null) {
//        $movie =  $this->movieRepository->where(['country_id' , $id])->get();
        $movie = Movie::where('country_id',$id)->paginate(10);
//        return $movie;
        $mostViewedMovies = $this->movieRepository->getMostViewedMovie()->take(3)->get();

        return view('client.page.movie.listMovieByCountry', [
//            'categories'  => $this->categories,
//            'countries'   => $this->countries,
            'mostViewedMovies'=> $mostViewedMovies,

            'movies'  => $movie,

        ] );
    }


}
