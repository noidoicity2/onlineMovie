<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;


use App\Http\Requests\Movie\AddMovieRequest;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    //
    protected  $movieRepository;
    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function all() {
        return $this->movieRepository->all();
//        return "dasd";
    }
    public function PostAddMovie(AddMovieRequest $request) {
        $movie =  $request->all();
//        return $movie;
//        return $movie;

        $img = $request->file('img')->getClientOriginalName();
        $filePath = $request->file('img')->storeAs('uploads', $img, 'public');
        $movie['img'] = Storage::url($filePath);
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
    public function Edit($id =null) {

    }
}
