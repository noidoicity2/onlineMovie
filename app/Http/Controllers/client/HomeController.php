<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\PurchaseMembership;
use App\Mail\Test;
use App\Models\Actor;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Movie;
use App\Models\MovieCategory;
use App\Models\Slider;
use App\Models\Transaction;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    }

    public function home() {

        $sliders = Slider::with('movie')->orderBy('display_order', 'asc')->get();
        $new_movies = Movie::NewestMovie()->limit(8)->with('episodes:name,movie_id')->get();
        $free_movies = Movie::where('is_free' ,1)->get();

        $recommendMovies = DB::select('select * from category  where id in (select b.category_id from favorite as a INNER JOIN movie_category as b on a.movie_id = b.movie_id where a.user_id = ? )', [Auth::id()] );
        $recommendMovies = array_column($recommendMovies, 'id');
        $mvs = Movie::select('id' , 'name', 'quality_label' , 'is_movie_series', 'slug' , 'img')->whereHas('categories', function (Builder $query) use($recommendMovies) {
            $query->whereIn('category_id', $recommendMovies);
        } )->take(8)->get();
//        return $mvs;

        $mostViewedMovies =   cache()->remember('mostViewedMovies' , 60*2 , function () {
            return $this->movieRepository->getMostViewedMovie()->take(5)->get();
        });

        $featuredActors = Actor::all();


        return view('client.page.movie.home', [

            'mostViewedMovies'=> $mostViewedMovies,
            'new_movies'  => $new_movies,
            'sliders'   => $sliders,
            'recommendedMovies' => $mvs,
            'featured_actors' => $featuredActors,
            'free_movies' => $free_movies

        ] );
    }
}
