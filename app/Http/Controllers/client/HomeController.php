<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\PurchaseMembership;
use App\Mail\Test;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Slider;
use App\Models\Transaction;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
//        $this->categories = Category::OnLyName()->get()->take(10);
//        $this->countries = $this->countryRepository->all()->take(5);
    }

    public function home() {
//        Mail::mailer('mailgun')->to(Auth::user())->send(new Test());


//        $new_movies = Movie::NewestMovie()->limit(20)->with('episodes:name,movie_id')->get();
        $sliders = Slider::with('movie')->orderBy('display_order', 'asc')->get();
        $new_movies = cache()->remember('new_movies' , 60*2 , function () {
           return  Movie::NewestMovie()->limit(20)->with('episodes:name,movie_id')->get();
        });
//        $mostViewedMovies = $this->movieRepository->getMostViewedMovie()->take(10)->get();
        $mostViewedMovies =   cache()->remember('mostViewedMovies' , 60*2 , function () {
            return $this->movieRepository->getMostViewedMovie()->take(10)->get();
        });
//        return $mostViewedMovies;
//        return  $new_movies;
        return view('client.page.movie.home', [

            'mostViewedMovies'=> $mostViewedMovies,
            'new_movies'  => $new_movies,
            'sliders'   => $sliders,

        ] );
    }
}
