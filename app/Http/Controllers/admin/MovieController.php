<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;


use App\Http\Requests\Movie\AddMovieRequest;
use App\Jobs\convertVideo;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Services\FIleUploadServices;
use App\Services\HlsServices;

use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSExporter;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;


class MovieController extends Controller
{
    //
    protected  $movieRepository;
    protected $categoryRepository;
    protected $countryRepository;
    public function __construct(MovieRepositoryInterface $movieRepository , CategoryRepositoryInterface $categoryRepository, CountryRepositoryInterface $countryRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->categoryRepository = $categoryRepository;
        $this->countryRepository = $countryRepository;
    }

    public function all() {
        return $this->movieRepository->all();
//        return "dasd";
    }
    public function PostAddMovie(AddMovieRequest $request) {
        $movie =  $request->all();
//        return $movie;
//        return $movie;
//        return $movie;

//        $img = $request->file('img')->extension();
//        $filePath = $request->file('img')->storeAs('uploads', $img, 'public');
        $slug = Str::slug($request->name);
        $imgPath = FIleUploadServices::UploadImage($request->file('img') ,$slug);
        $bgPath =  FIleUploadServices::UploadImage($request->file('bg_img') , $slug);
        $movie['img'] = Storage::url($imgPath);
        $movie['bg_img'] = Storage::url($bgPath);
//        $contents = Storage::url($filePath );
//        return $contents;


//        $paths = Storage::putFileAs('imag' , $request->file('img'))

        $this->movieRepository->create($movie);
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
        return view('admin.page.movie.addMovie', [
            'countries'    => $countries,


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
    public function testHls() {
//        $format = new X264('aac', 'libx264');
//        $lowBitrate = new X264('aac', 'libx264');
//        $lowBitrate->setKiloBitrate(200);
//        $midBitrate = (new X264)->setKiloBitrate(500);
//        $highBitrate = (new X264)->setKiloBitrate(1000);
//        $encryptionKey = HLSExporter::generateEncryptionKey();
//
////        FFMpeg::openUrl('https://videocoursebuilder.com/lesson-1.mp4');
//
////        FFMpeg::open('H:\Project\Laravel_project\onlineMovie\storage\uploads\react.MP4')
////            ->exportForHLS()
////            ->setSegmentLength(10) // optional
////            ->addFormat($lowBitrate)
////            ->save('H:\Project\Laravel_project\onlineMovie\storage\uploads\test.m3u8');
//        $media = FFMpeg::fromDisk('uploads')->open('react.MP4')
//        ->exportForHLS()->withEncryptionKey($encryptionKey)->setSegmentLength(60)
//            ->addFormat($lowBitrate)
//        ->save('3/test.m3u8');
        $this->dispatch(new  convertVideo());
       return "dasda";

//        return '<img src='. $url .' />';

    }



}
