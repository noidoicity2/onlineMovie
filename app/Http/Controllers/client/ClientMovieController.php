<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BookMark;
use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Favorite;
use App\Models\Movie;
use App\Models\MovieRating;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


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
            'categories'=>$this->categories,
            'countries'   => $this->countries,
            'rating_point' => $rating_point,
            'avg_rating' => $avg_rating,
            'is_liked'  => $is_liked,

        ]);
    }

    public function ListEpisode($slug =null , $id = null) {
        $episodes = Episode::where('movie_id' , $id)->with('movie')->get();

        return view('client.page.movie.listEpisode' , [
            'episodes' => $episodes
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
        $favorite_movie = Favorite::where('user_id' , Auth::id())->with('movie')->paginate(5);
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
        $bookmarks = BookMark::where('user_id' , Auth::id())->paginate(5);
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
                    $query->where('id' ,$request->category_id );
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
        $movies = Movie::where('is_movie_series' ,1)
            ->select('name' , 'id' ,'en_name' , 'img' , 'is_free' ,'slug')
            ->orderBy('created_at' , 'desc')->paginate(20);
        return view('client.page.movie.SeriesMovie' , [
            'movies' => $movies
        ]);
    }


}
