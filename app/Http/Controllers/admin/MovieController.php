<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;


use App\Http\Requests\Movie\AddMovieRequest;
use App\Jobs\HandleVideoUpload;
use App\Models\MovieCategory;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\MovieCategoryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Repositories\MovieCategoryRepository;
use App\Services\FIleUploadServices;
use App\Services\HlsServices;

use Exception;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSExporter;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use function PHPUnit\Framework\stringStartsWith;


class MovieController extends Controller
{
    //
    protected $movieRepository;
    protected $categoryRepository;
    protected $countryRepository;
    protected $movieCategoryRepository;
    public function __construct(MovieRepositoryInterface $movieRepository ,
                                CategoryRepositoryInterface $categoryRepository,
                                CountryRepositoryInterface $countryRepository,
                                MovieCategoryRepositoryInterface $movieCategoryRepository
    )
    {
        $this->movieRepository         = $movieRepository;
        $this->categoryRepository      = $categoryRepository;
        $this->countryRepository       = $countryRepository;
        $this->movieCategoryRepository = $movieCategoryRepository;
    }

    public function all() {
        return $this->movieRepository->all();
//        return "dasd";
    }
    public function PostAddMovie(AddMovieRequest $request) {
        $movie = $request->all() ;

//        return $movie['category'];

        $slug = Str::slug($request->name);
        $imgPath    =   FIleUploadServices::UploadImage($request->file('img') ,$slug);
        $bgPath     =   FIleUploadServices::UploadImage($request->file('bg_img') , $slug);
        $videoPath  =   FIleUploadServices::UploadVideo($request->file('source_url') , $slug);
//        $request->file('source_url')->getClientOriginalName();
        $movie['img']           =   Storage::url($imgPath);
        $movie['bg_img']        =   Storage::url($bgPath);
        $movie['source_url']    =   Storage::url($videoPath);
        $movie['hls_url']       = '/storage/videos/'.$slug.'/'.$slug.'.m3u8';
        $movie['low_hls_url']   = '/storage/videos/'.$slug.'/'.$slug.'_0_200'.'.m3u8';
        $movie['description']   = htmlentities($request->description);

        $categories = $movie['category'];
        $insert_data =  array();
        $test = array();
        DB::beginTransaction();
        try {
            $created_movie = $this->movieRepository->create($movie);
            for ($i =0 ; $i <count($categories) ;$i ++) {
                array_push($insert_data , array('category_id' => $categories[$i] , 'movie_id'=>$created_movie->id) );
            }

            $this->movieCategoryRepository->insert($insert_data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
//        $created_movie = $this->movieRepository->create($movie);
//return $created_movie;


//        dd($insert_data);
//        for ($i =0 ; $i <count($insert_data) ;$i ++) {
////         return  $insert_data[$i];
////           return $j;
//            $this->movieCategoryRepository->create(['category_id'=> $insert_data[$i]['category_id'], 'movie_id' => $insert_data['$i']['movie_id']]);
//        }

//        $this->movieCategoryRepository->create($;




//        $job = (new HandleVideoUpload());
        $this->dispatch(new HandleVideoUpload($videoPath,$slug , $request->file('source_url')->extension()));
//        $this->uploadVideo($videoPath, $slug ,$request->file('source_url')->extension());
//        $this->movieRepository->create($movie);
        return back()->with([
            'message' =>  "Add Movie successfully"
        ]);


    }
    public function PostEditMovie() {

    }
    public function Add($id =null) {
//        $category = $this->categoryRepository->getCategoryForSelect()->get();
//        return  $category;
        $countries = $this->countryRepository->getCountryForSelect()->get();
        $categories = $this->categoryRepository->getCategoryForSelect()->get();
        return view('admin.page.movie.addMovie', [
            'countries'    => $countries,
            'categories'    => $categories,


        ]);
    }

    public function ListMovie($paginate = 0 , $orderBy = 'desc')  {
//        $paginate ? 0 == $paginate : 10 ;

        $orderArr = array('asc' , 'desc');
        if(!in_array($orderBy , $orderArr)) $orderBy = 'desc';
        $movies = $this->movieRepository->listMovie($paginate, $orderBy);
//return $movies;
       return  view('admin.page.movie.listMovies' , [
           'movies'  => $movies,
           'title'  => "list Movies"
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



}
