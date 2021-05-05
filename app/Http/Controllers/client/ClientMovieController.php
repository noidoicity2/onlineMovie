<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\BookMark;
use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Favorite;
use App\Models\Movie;
use App\Models\MovieActor;
use App\Models\MovieCategory;
use App\Models\MovieComment;
use App\Models\MovieRating;
use App\Models\RequestMovie;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Repositories\Interfaces\MovieViewRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;


class ClientMovieController extends Controller
{
    //
    protected  $movieRepository;
    protected  $countryRepository;
    protected $episodeRepository;
    protected  $movieViewRepository;

    protected $categories ;
    protected $countries;

    public function __construct(MovieRepositoryInterface $movieRepository,
                                EpisodeRepositoryInterface $episodeRepository ,
                                CountryRepositoryInterface $countryRepository,
                                MovieViewRepositoryInterface $movieViewRepository   )
    {
        $this->movieRepository = $movieRepository;
        $this->episodeRepository = $episodeRepository;
        $this->countryRepository =$countryRepository;
        $this->movieViewRepository = $movieViewRepository;

//        $this->categories = Category::OnLyName()->get()->take(10);
//        $this->countries = $this->countryRepository->getCountryForSelect()->take(5)->get();
    }

    public function Index() {

//        return view('client.page.movie.home');
    }
    public function GetMovieBySlug($slug =null , $id = null) {

        $movie  = $this->movieRepository->get($id);
        $categories = MovieCategory::with('category')->where('movie_id' , $id)->get();
        $actors = MovieActor::with('actor')->where('movie_id' , $id)->get();
        if($movie->is_free == 0 && !Auth::check()) {
            return view('Share.upgradeVip');
        }
        $episodes = $movie->episodes;
        $comments = MovieComment::with('user')->where('movie_id', $movie->id)->orderBy('created_at' , 'desc')->take(5)->get();
//       return $comments;
//        dd($comments);
//        $comments = MovieComment::where('')
        $rating_point = 0;
        $favorite = Favorite::where([
           'movie_id' => $movie->id,
           'user_id'  => Auth::id(),
        ])->first();
        $is_liked= 0;
        if($favorite != null) {
            $is_liked = 1;
        }
        $rating = MovieRating::where([
            'user_id' => Auth::id(),
            'movie_id'=> $movie->id,
        ])->select('rating_point')->first();
        $rating_count = MovieRating::where('movie_id' , $movie->id)->count();



        if($rating == null) {
            $rating_point = 0;
        }
        else {
            $rating_point = $rating->rating_point;
        }

        $avg_rating = MovieRating::where([
            'movie_id' => $movie->id,

        ])->avg('rating_point');

//        return $episodes;

//        return ($movie);

        return view('client.page.movie.detail' , [
            'movie'=>$movie,
            'episode' => $episodes,
//            'categories'=>$this->categories,
            'countries'   => $this->countries,
            'rating_point' => $rating_point,
            'avg_rating' => $avg_rating,
            'is_liked'  => $is_liked,
            'comments' => $comments,
            'rating_count' => $rating_count,
            'categories' => $categories,
            'actors' => $actors

        ]);
    }

    public function ListEpisode($slug =null , $id = null) {
        $episodes = Episode::where('movie_id' , $id)->with('movie')->get();
//return  $episodes;
        return view('client.page.movie.listEpisode' , [
            'episodes' => $episodes
        ]);
    }
    public function Watch($slug =null , $id = null) {
//        return "adsad";
        $movie = $this->movieRepository->get($id);
//        $movie->source_url = URL::te
        Movie::find($id)->increment('view_count');
        $bookmark = BookMark::where('movie_id' , $id)
            ->where('user_id' , Auth::id())->first();
//        return $bookmark;
//        if($bookmark->count() ==0) $bookmark=

        $this->movieViewRepository->create([
            'movie_id' => $id,
            'user_id' => Auth::id(),
        ]);
        if(!Auth::check() && $movie->is_free == 1) {
            return view ('client.page.movie.watchFree' , [
                'movie' => $movie ,
                'categories'=>$this->categories,


            ]);
        }


        return view ('client.page.movie.watch' , [
            'movie' => $movie ,
            'categories'=>$this->categories,
            'bookmark' => $bookmark

        ]);

    }
    public function WatchBackUpMovie($slug =null , $id = null) {
        $movie = $this->movieRepository->get($id);

        Movie::find($id)->increment('view_count');
        $this->movieViewRepository->create([
            'movie_id' => $id,
            'user_id' => Auth::id(),
        ]);
//        return $movie->episodes;

        return view ('client.page.movie.watchBackUp' , [
            'movie' => $movie ,
            'categories'=>$this->categories,
//            'countries'   => $this->countries,
        ]);

    }
    public function GetMovieByCategory ($slug =null , $id = null) {
        $movies = Movie::whereHas('categories' , function ( Builder $query) use ($id) {
            $query->where('category_id' , $id );
        })->paginate(8);
//        $movies = Movie::with('categories')->get();
//        return $movies;
        return view('client.page.movie.listMovieByCategory' , [
            'movies' => $movies,
        ]);
    }
    public function WatchEpisode($slug = null , $id = null) {
        $episode = Episode::find($id);

        return view('client.page.movie.watchEpisode' ,[
            'episode' => $episode,
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
    public  function Favorite() {
//        return "đá";
        $favorite_movie = Favorite::where('user_id' , Auth::id())->with('movie' )->withCount('episodes')->latest()->paginate(8);
//        return $favorite_movie;
//        $favorite_movie  = Cache::remember('favorite')
//     return $favorite_movie;
        return view('client.page.movie.favorite' , [
           'favorite_items' => $favorite_movie
        ]);


    }
    public function PostAddFavorite(Request $request) {
        $favorite= Favorite::where([
            'user_id' => Auth::id(),
            'movie_id'=>$request->movie_id])->first();
        if($favorite == null) {
            Favorite::create([
                'user_id' => Auth::id(),
                'movie_id'=>$request->movie_id,
            ]);

            return json_encode([
                'success' => true ,
                'message' => "add to favorite successfully"
            ]);
        }
        else {
           Favorite::destroy($favorite->id);
            return json_encode([
                'success' => true ,
                'message' => "You unliked this movie"]);
        }

    }

    public function PostBookMark(Request $request) {
        $bookMark = BookMark::where(['user_id' => Auth::id() , 'movie_id' =>$request->movie_id  ])->first();
//        dd($bookMark);
//        return  compact($bookMark);
        if($bookMark ==null) {
            BookMark::create([
                'user_id' => Auth::id(),
                'movie_id'=> $request->movie_id,
                'episode_id' =>$request->episode_id,
                'position' =>$request->position,
            ]);
            return json_encode([
                "success" => true,
                "message"=> "bookmark movie successfully",

            ]);
        }

        BookMark::find($bookMark->id)->update(['position' => $request->position]);
        return json_encode([
            "success" => true,
            "message"=> "update bookmark movie successfully",

        ]);



    }
    public function GetBookMarkMovie() {
        $bookmarks = BookMark::where('user_id' , Auth::id())->paginate(8);
        return view('client.page.movie.bookMarkedMovie' , [
            'bookmarks' => $bookmarks
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
    public function Filter(Request $request) {
        $selectCategories = Category::CategoryForSelect()->get();
        $selectCountries = Country::CountryForSelect()->get();

        $whereArray = [
            'published_at' =>  $request->published_at ,
            'country_id'        => $request->country_id,
            'is_on_cinema' => $request->is_on_cinema,
            'is_free' => $request->is_free,
            'is_movie_series' => $request->is_movie_series,
        ];
        $filterWhere = array_filter($whereArray , function ($value) {
            return $value != ""&&$value !=null;
        });
//        return $request->name;
//        dd($filterWhere);
//        return $request->category_id;
        if($request->category_id == "") {
            $movies  = Movie::where('name' , 'like' , '%'.$request->name.'%')
                ->where($filterWhere)
                ->paginate(12);
        }
        else{
            $movies  = Movie::where('name' , 'like' , '%'.$request->name.'%')
                ->where($filterWhere)
                ->whereHas('categories' , function ( Builder $query) use ($request) {
                    $query->where('category_id' ,$request->category_id );
                })
                ->paginate(12);
        }


        return view('client.page.movie.filter' , [
            'movies' => $movies,
            'selectCategories' => $selectCategories,
            'selectCountries' => $selectCountries,
            'keyword'   => $request->name,

        ]);

    }

    public  function  GetMovieSeries() {
        $movies = $this->movieRepository->getSeriesMovies();
        return view('client.page.movie.SeriesMovie' , [
            'movies' => $movies
        ]);
    }

    public function GetTheaterMovie() {
        $movies = $this->movieRepository->getCinemaMovies();
        return view('client.page.movie.theaterMovie' , [
            'movies' => $movies,
        ]);

    }
    public function GetMovieByActor($slug = null , $id =null) {
        $movies = Movie::whereHas('movieActors' , function ( $query) use ($id) {
           $query->where('actor_id' , $id);

        })->paginate(8);
        $actor= Actor::find($id);
//        return  $actor;
        return view('client.page.movie.getMovieByActor' , [
            'movies' => $movies,
            'actor' => $actor
        ]);
    }
    public function RequestMovie () {
//        $movie =
        $movieRequests = RequestMovie::where('user_id' , Auth::id())->get();

        return view('client.page.movie.requestMovie' , [
            'movieRequests' => $movieRequests
        ] );
    }
    public function PostRequestMovie (Request  $request) {
//        $movie =
        RequestMovie::create([
            'user_id' => Auth::id(),
            'movie_name'=> $request->movie_name,
            'director_name' => $request->director_name,
        ]);
        return back()->with([
            'message' => "Thanks for your request"
        ]);
    }

}
