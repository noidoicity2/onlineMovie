<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\AddMovieRequest;
use App\Http\Requests\Movie\EditMovieRequest;
use App\Jobs\HandleUploadEpisode;
use App\Jobs\HandleVideoUpload;
use App\Models\Actor;
use App\Models\Country;
use App\Models\Director;
use App\Models\Movie;
use App\Models\MovieActor;
use App\Models\MovieCategory;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\DirectorRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\MovieCategoryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Services\FileUntil;
use App\Services\FIleUploadServices;
use Exception;
use FFMpeg\Format\Video\X264;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSExporter;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;


class MovieController extends Controller
{
    //
    protected $movieRepository;
    protected $categoryRepository;
    protected $countryRepository;
    protected $movieCategoryRepository;
    protected $directorRepository;
    protected $episodeRepository;
    public function __construct(MovieRepositoryInterface            $movieRepository ,
                                CategoryRepositoryInterface         $categoryRepository,
                                CountryRepositoryInterface          $countryRepository,
                                MovieCategoryRepositoryInterface    $movieCategoryRepository,
                                DirectorRepositoryInterface         $directorRepository,
                                EpisodeRepositoryInterface          $episodeRepository)
    {
        $this->movieRepository         = $movieRepository;
        $this->categoryRepository      = $categoryRepository;
        $this->countryRepository       = $countryRepository;
        $this->movieCategoryRepository = $movieCategoryRepository;
        $this->directorRepository            = $directorRepository;
        $this->episodeRepository = $episodeRepository;
    }

    public function all() {
        return $this->movieRepository->all();

    }
    public function PostAddMovie(AddMovieRequest $request) {

        $movie = $request->all() ;
//        return $movie;
        $slug = Str::slug($request->name);
        $imgPath    =   FIleUploadServices::UploadImage($request->file('img') ,$slug);
        $bgPath     =   FIleUploadServices::UploadImage($request->file('bg_img') , $slug);

        $movie['img']           =   Storage::url($imgPath);
        $movie['bg_img']        =   Storage::url($bgPath);
//        return $request->file('source_url');
        if($request->file('source_url')!="") {

            $videoPath  =   FIleUploadServices::UploadVideo($request->file('source_url') , $slug);
            $movie['source_url']    =   Storage::url($videoPath);
            $movie['hls_url']       = '/storage/videos/'.$slug.'/'."video".'.m3u8';
            $movie['low_hls_url']   = '/storage/videos/'.$slug.'/'."video".'_0_200'.'.m3u8';
            $this->dispatch(new HandleVideoUpload($videoPath,$slug , $request->file('source_url')->extension()));
        }


        $movie['description']   = htmlentities($request->description);

        $categories = $movie['category'] ;
        $actors = $movie['actor'] ;

        $insert_categories =  array();
        $insert_actor = array();
        $test = array();
        DB::beginTransaction();
        try {
            $created_movie = $this->movieRepository->create($movie);
            for ($i =0 ; $i <count($categories) ;$i ++) {
                array_push($insert_categories , array('category_id' => $categories[$i] , 'movie_id'=>$created_movie->id) );
            }
            for ($i =0 ; $i <count($actors) ;$i ++) {
                array_push($insert_actor , array('actor_id' => $actors[$i] , 'movie_id'=>$created_movie->id) );
            }

            $this->movieCategoryRepository->insert($insert_categories);
            MovieActor::insert($insert_actor);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

//            throw new Exception($e->getMessage());
            return back()->with([
                'error' =>  "Failed to add movie"
            ]);
        }


        if($created_movie->is_movie_series == 1) {
            return json_encode([
                'message' =>  "Add Movie successfully",
                'redirectUrl' => route('add_episode' , ['id' =>$created_movie->id]),
            ]);

        }
;
//        return back()->with([
//            'message' =>  "Add Movie successfully"
//        ]);
        return json_encode([
            'message' =>  "Add Movie successfully",
            'redirectUrl' => route('add_movie' )
        ]);


    }
    public function PostDeleteMovie(Request $request) {
        try{
            Movie::destroy($request->id);
            return json_encode([
                'success' => true ,
                'message' => "delete movie successfully",
            ]);
        }
        catch (Exception $exception) {
            return json_encode([
                'success' => true ,
                'message' => "cannot delete movie",
            ]);
        }
    }
    public function PostEditMovie(EditMovieRequest $request) {
        $movie = $request->except('id') ;
        $old_movie = Movie::find($request->id);
        $slug = Str::slug($request->name);
        if($movie['slug']=="") $movie['slug'] = $slug;
        $movie = array_filter($movie, function ($value) {
            return $value != null;
        } );


//return $movie;

        if($request->file('img')!="") {
//            return "adsa";
            $imgPath    =   FIleUploadServices::UploadImage($request->file('img') ,$slug);
//            FileUntil::DeleteFileFromUrl($old_movie->img);
            $movie['img']           =   Storage::url($imgPath);
        }
        if($request->file('bg_img')!="") {
            $bgPath     =   FIleUploadServices::UploadImage($request->file('bg_img') , 'bg_'.$slug);

            $movie['bg_img']        =   Storage::url($bgPath);
        }

        if($request->file('source_url')!="") {

            FileUntil::DeleteAllVideoFromSlug($old_movie->slug);
            $videoPath  =   FIleUploadServices::UploadVideo($request->file('source_url') , $slug);
            $movie['source_url']    =   Storage::url($videoPath);
            $movie['hls_url']       = '/storage/videos/'.$slug.'/'."video".'.m3u8';
            $movie['low_hls_url']   = '/storage/videos/'.$slug.'/'."video".'_0_200'.'.m3u8';
            $this->dispatch(new HandleVideoUpload($videoPath,$slug , $request->file('source_url')->extension()));
        }


        $movie['description']   = htmlentities($request->description);


        $categories = $movie['category'] ;
        $actors = $movie['actor'] ;

        $insert_categories =  array();
        $insert_actor = array();
//        $test = array();

            $affected_rows = $this->movieRepository->update($request->id,$movie);
            for ($i =0 ; $i <count($categories) ;$i ++) {
                array_push($insert_categories , array('category_id' => $categories[$i] , 'movie_id'=>$request->id) );
            }
            for ($i =0 ; $i <count($actors) ;$i ++) {
                array_push($insert_actor , array('actor_id' => $actors[$i] , 'movie_id'=>$request->id) );
            }

            MovieCategory::where('movie_id' , $request->id)->delete();
            MovieActor::where('movie_id' , $request->id)->delete();

            $this->movieCategoryRepository->insert($insert_categories);
            MovieActor::insert($insert_actor);



        return json_encode([
            'message' =>  "Update Movie successfully",
            'redirectUrl' => route('list_movie' )
        ]);


    }
    public function EditMovie($id) {
        $countries = $this->countryRepository->getCountryForSelect()->get();
        $movie = $this->movieRepository->get($id);
        $directors = $this->directorRepository->all();

        $categories = $this->categoryRepository->getCategoryForSelect()->get();
        $selectedCategories = MovieCategory::select('category_id')->where('movie_id' ,$id)->pluck('category_id')->toArray();

        $selectCats= $this->toChoiceJsArray($selectedCategories, $categories);

        $actors = Actor::all();
        $selectedActors = MovieActor::select('actor_id')->where('movie_id' ,$id)->pluck('actor_id')->toArray();

        $selectedActData = $this->toChoiceJsArray($selectedActors , $actors);
//        return $movie;

//        return  $selectedCategories;
        return view('admin.page.movie.editMovie', [
            'movie'  => $movie,
            'directors'     => $directors,
            'countries' => $countries,
            'categories'    => $categories,
            'selected_categories' => $selectCats,
            'selected_actors' => $selectedActData

        ]);

    }
    public function Add($id =null) {

        $countries = $this->countryRepository->getCountryForSelect()->get();
        $categories = $this->categoryRepository->getCategoryForSelect()->get();
        $directors = $this->directorRepository->all();
        $actor = Actor::all();

        return view('admin.page.movie.addMovie', [
            'countries'     => $countries,
            'categories'    => $categories,
            'directors'     => $directors,
            'actors' => $actor,



        ]);
    }

    public function ListMovie(Request $request)  {
        $whereArray = [
//            'published_at' =>  $request->published_at ,
            'country_id'        => $request->country_id,
            'is_on_cinema' => $request->is_on_cinema,
            'is_free' => $request->is_free,
            'is_movie_series' => $request->is_movie_series,
            'director_id' => $request->director_id

        ];
        $search = $request->keyword;
        $filterWhere = array_filter($whereArray , function ($value) {
            return $value != ""&&$value !=null;
        });
//        return $filterWhere;

        if($request->category_id == "") {
            $movies  =  Movie::with('episodes')
                ->where('name', 'like' , "%$search%")
                ->where($filterWhere)
                ->latest()
                ->paginate(20);
        }
        else{
            $movies  =  Movie::with('episodes')
                ->where('name', 'like' , "%$search%")
                ->where($filterWhere)
                ->whereHas('categories' , function ( Builder $query) use ($request) {
                    $query->where('category_id' ,$request->category_id );
                })
                ->whereHas('movieActors' , function ( Builder $query) use ($request) {
                    $query->where('actor_id' ,$request->actor_id );
                })
                ->latest()
                ->paginate(20);
        }

        $selectCategories = $this->categoryRepository->all();
        $selectCountries =Country::all();
        $selectActors = Actor::all();
        $selectDirector = Director::all();



//        if($search != "") {
//            $movies =   Movie::with('episodes')
//                ->where('name', 'like' , "%$search%")
//                ->latest()->paginate(20);
//        }
//        else {
//            $movies = Movie::with('episodes')->latest()->paginate(20);
//        }

//return $movies;
       return  view('admin.page.movie.listMovies' , [
           'movies'  => $movies,
           'title'  => "list Movies",
           'selectCategories' => $selectCategories ,
           'selectCountries' => $selectCountries ,
           'selectActors' => $selectActors,
           'selectDirectors' => $selectDirector,
       ]);

    }

    private function uploadVideo($video , $slug , $extention) {
        $lowBitrate = new X264('aac', 'libx264');
        $lowBitrate->setKiloBitrate(200);

        $highRate =  (new X264('aac', 'libx264'))->setKiloBitrate(1000);
//
//        $midBitrate = (new X264)->setKiloBitrate(500);
//        $highBitrate = (new X264)->setKiloBitrate(1000);
        $encryptionKey = HLSExporter::generateEncryptionKey();
//        $en =  HLSExporter::ge
        Storage::put($video.'secret.key', $encryptionKey);
        Storage::disk('public' )->put('videos/'.$slug.'/'.'secret.key' , $encryptionKey);

        $media = FFMpeg::fromDisk('public')
            ->open('videos/'.$slug.'/'.$slug.'.'.$extention)
            ->exportForHLS()
            ->withEncryptionKey($encryptionKey)
            ->setSegmentLength(5)
            ->addFormat($lowBitrate)
            ->addFormat($highRate)
            ->toDisk('public')
            ->save('videos/'.$slug.'/'.$slug.'.m3u8');
        info("ok");
    }

    public function FilterMovie($keyword=null ,
                                $category = null ,
                                $country = null ,
                                $director = null, $actor = null)
    {
//        $Movie

    }

    public function AddEpisode($id=null) {
        $movie = $this->movieRepository->get($id);

        return view('admin.page.movie.addEpisode' ,[
            'movie' => $movie
        ]);
    }
    public function PostAddEpisode(Request $request) {

        $movie = $this->movieRepository->get($request->id);
        $names =$request->input('episode');
        $files = $request->file('episode');
        $episode = array();
//        dd($names);
        for ($i= 0 ; $i< count($files) ; $i ++) {


//              echo ($files[$i]['url']->getClientOriginalName()) ;
            $name = Str::slug(($names[$i]['name']));
            $extension = $files[$i]['url']->extension();
//            dd($name);
//            $videoPath  =   FIleUploadServices::UploadVideo($request->file('source_url') , $slug);
            $filePath =  FIleUploadServices::UploadEpisode($files[$i]['url'], $movie->slug ,$name);

            $episode['source_url']    =   Storage::url($filePath);
            $episode['hls_url']       = '/storage/videos/'.$movie->slug.'/'.$name.'/'."video".'.m3u8';
            $episode['low_hls_url']   = '/storage/videos/'.$movie->slug.'/'.$name.'/'."video".'_0_200'.'.m3u8';

            $this->episodeRepository->create([
               'name' => $names[$i]['name'],
                'movie_id' => $movie->id,
                'source_url' =>  $episode['source_url']  ,
                'hls_url'=>   $episode['hls_url']  ,
                'low_hls_url' =>    $episode['low_hls_url']

            ]);

            $this->dispatch(new HandleUploadEpisode($filePath, $movie->slug ,$extension ,$name));
        }
        return back()->with([
            'success' => true ,
            'message' => "Add episode successfully",
        ]);


    }

    private  function toChoiceJsArray($selectArray , $collection) {
        $data= [];
        foreach ($collection as $cat) {
            if(in_array($cat->id , $selectArray)) {
                array_push($data, ['value' => $cat->id , 'label' => $cat->name , 'selected' => true]);
            }
            else {
                array_push($data, ['value' => $cat->id , 'label' => $cat->name , 'selected' => false]);
            }

        }
        return $data;
    }



}
