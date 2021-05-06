<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Director\AddDirectorRequest;
use App\Models\Director;
use App\Services\FileUntil;
use App\Services\FIleUploadServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DirectorController extends Controller
{
    //

    public function Add() {
        return view('admin.page.director.addDirector');
    }
    public function Edit($id = null) {
        $director = Director::find($id);
        return view('admin.page.director.editDirector', [
            'director' => $director
        ]);
    }
    public function PostEditDirector(Request $request) {

        $director = Director::find($request->id);
        $updateData = $request->except('id');
        $old_img = $director->img;

        if($request->img != null) {
            FileUntil::DeleteImageFromSlug($old_img);
            $img_path = FIleUploadServices::UploadImage($request->img , Str::slug($request->name));
            $updateData['img'] = Storage::url($img_path);
        }
        $rows = $director->update($updateData);


        if($rows> 0) {
            return back()->with([
                'success' => true ,
                'message' => "Update ditector successfully"
            ]);
        }
        else {
            return back()->withErrors([
                'error' => 'error cannot update director'
            ]);
        }
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

    public function ListDirector () {
        $director = Director::all();

        return view ('admin.page.director.listDirectors' , [
            'directors' => $director
        ]);
    }

    public function PostDelete(Request  $request) {
        $id = $request->id;
        try{
            Director::destroy($id);
            return json_encode([
                'success' => true,
                'message' => "delete director successfully",
            ]);
        }
        catch (\Exception $exception) {
            return json_encode([
//                'success' => false,
                'message' => "Cannot delete director",
            ]);
        }
    }
}
