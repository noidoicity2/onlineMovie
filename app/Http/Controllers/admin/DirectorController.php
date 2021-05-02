<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Director\AddDirectorRequest;
use App\Models\Director;
use App\Services\FIleUploadServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DirectorController extends Controller
{
    //

    public function AddDirector() {
        return view('admin.page.director.addDirector');
    }
    public function PostAddDirector(AddDirectorRequest $request) {

        $imgPath    =   FIleUploadServices::UploadImage($request->file('img') ,Str::slug($request->name));
        $director = $request->all();
        $director['img']           =   Storage::url($imgPath);

        Director::create($director);
        return back()->with([
            'message' => "add director sucessfully"
        ]);

    }
}
