<?php


namespace App\Services;


 class FIleUploadServices
{
    public static function UploadImage($file , $name) {
        $extension = $file->extension();
//       return $file->storeAs('uploads', $img_name, 'public');
        return $file->storeAs('images/'.$name, $name.'.'.$extension , 'public');

 }
     public static function UploadVideoQuality($file , $name , $quality) {
         $extension = $file->extension();
//       return $file->storeAs('uploads', $img_name, 'public');
         return $file->storeAs('videos/'.$quality.$name, $name.'.'.$extension , 'public');

     }

     public static function UploadVideo($file , $name  ) {
         $extension = $file->extension();
//       return $file->storeAs('uploads', $img_name, 'public');
         return $file->storeAs('videos/'.$name, $name.'.'.$extension , 'public');

     }

     public static function UploadEpisode($file , $name ,$episodeName ) {
         $extension = $file->extension();
//       return $file->storeAs('uploads', $img_name, 'public');
         return $file->storeAs('videos/'.$name.'/'.$episodeName, $episodeName.'.'.$extension , 'public');

     }


}
