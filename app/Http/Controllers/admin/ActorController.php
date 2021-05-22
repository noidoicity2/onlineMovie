<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Services\FileUntil;
use App\Services\FIleUploadServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActorController extends Controller
{
    //
    public function Add() {
        return view('admin.page.actor.addActor');
    }
    public function Edit($id = null) {
        $actor = Actor::find($id);
        $ads = "dasda";
//        dasdas feature 2
//        featur 3
//        featur e4
        return view('admin.page.actor.editActor', [
            'actor' => $actor
        ]);
    }
    public function PostEditActor(Request $request) {

        $actor = Actor::find($request->id);

        $updateData = $request->except('id');
        $old_img = $actor->img;

        if($request->img != "") {
            FileUntil::DeleteImageFromSlug($actor->slug);
//            return "dasd";
            $img_path = FIleUploadServices::UploadImage($request->img , Str::slug($request->name));
            $updateData['img'] = Storage::url($img_path);
        }
        $rows = $actor->update($updateData);


        if($rows> 0) {
            return back()->with([
                'success' => true ,
                'message' => "Update actor successfully"
            ]);
        }
        else {
            return back()->withErrors([
                'error' => 'error cannot update actor'
            ]);
        }
    }
    public function PostAddActor(Request $request) {

        $imgPath    =   FIleUploadServices::UploadImage($request->file('img') ,Str::slug($request->name));
        $actor = $request->all();
        $actor['img']           =   Storage::url($imgPath);

        Actor::create($actor);
        return back()->with([
            'message' => "add Actor sucessfully"
        ]);

    }

    public function ListActor () {
        $actor = Actor::all();

        return view ('admin.page.actor.listActor' , [
            'actors' => $actor
        ]);
    }

    public function PostDelete(Request  $request) {
        $id = $request->id;
        try{
            Actor::destroy($id);
            return json_encode([
                'success' => true,
                'message' => "delete actor successfully",
            ]);
        }
        catch (\Exception $exception) {
            return json_encode([
//                'success' => false,
                'message' => "Cannot delete actor",
            ]);
        }
    }
}
