<?php


namespace App\Services;


 class FIleUploadServices
{
    public static function UploadImage($file , $name) {
        $extension = $file->extension();
//       return $file->storeAs('uploads', $img_name, 'public');
        return $file->storeAs('images/'.$name, $name.'.'.$extension , 'public');

 }


}
