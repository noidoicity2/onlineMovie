<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    //
    protected $categories;
    protected $countries;

    protected  $movieRepository;
    protected  $countryRepository;

    public function __construct(MovieRepositoryInterface $movieRepository,
                                CountryRepositoryInterface $countryRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->countryRepository = $countryRepository;
        $this->categories = Category::OnLyName()->get()->take(10);
        $this->countries = $this->countryRepository->all()->take(5);
    }

    public function home() {

        $new_movies = Movie::NewestMovie()->limit(20)->with('episodes:name,movie_id')->get();
        $mostViewedMovies = $this->movieRepository->getMostViewedMovie()->take(10)->get();
//        return $mostViewedMovies;
//        return  $new_movies;
        return view('client.page.movie.home', [
            'categories'  => $this->categories,
            'countries'   => $this->countries,
            'mostViewedMovies'=> $mostViewedMovies,

            'new_movies'  => $new_movies,

        ] );
    }
}
