<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\FIleUploadServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    //
    public function AddSlider() {
        return view('admin.page.slider.addSlider' );
    }
    public function EditSlider() {

    }
    public  function ListSlider() {

    }
    public function PostAddSlider(Request  $request) {
        $imgPath = FIleUploadServices::UploadSliderImage($request->file('image_url') , $request->file('image_url')->getClientOriginalName());
        Slider::create([
            'name' => $request->name,
            'description' =>$request->description,
            'image_url' => Storage::url($imgPath),
            'movie_id'  => $request->movie_id,
            'display_order' => $request->display_order
        ]);

        return back()->with([
            'message' => "add slider successfully",
        ]);


    }
    public function PostDeleteSlider() {

    }
    public function PostUpdateSlider() {

    }
}
