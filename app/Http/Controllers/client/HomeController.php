<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\PurchaseMembership;
use App\Mail\Test;
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
//        $favoriteCategories = Movie::whereHas('favoriteMovies' , function (Builder $query ){
//           $query->select('movie_id')->where
//        });
//        $recommendMovies = Favorite::where('user_id', Auth::id())->inRandomOrder()->take(2)->with('movieCategories' ,function (Builder $query){
//            $query->addSelect('category_id');
//        })->get();
        $recommendMovies = DB::select('select * from category where id in (select b.category_id from favorite as a INNER JOIN movie_category as b on a.movie_id = b.movie_id where a.user_id = ?)', [Auth::id()] );
        $recommendMovies = array_column($recommendMovies, 'id');
        $mvs = Movie::select('id' , 'name' , 'slug' , 'img')->whereHas('categories', function (Builder $query) use($recommendMovies) {
            $query->whereIn('category_id', $recommendMovies);
        } )->get();
//        return $mvs;
//         $movieCategories = MovieCategory::distinct('movie_id')->whereIn('category_id' , $recommendMovies)->with('movie')->get();
//return $movieCategories;
//        $recommendMovies = new Collection($recommendMovies);
//        return $recommendMovies;
//        return Category::hydrate($recommendMovies)->withCount('movieCategories');
//        $recommendMovies = Movie::whereHas
//        return $recommendMovies->pluck('id');
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
            'recommendedMovies' => $mvs,

        ] );
    }
}
