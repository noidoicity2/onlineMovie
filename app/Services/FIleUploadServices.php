<?php


namespace App\Services;


 class FIleUploadServices
{
    public static function UploadImage($file , $name) {
        $extension = $file->extension();
//       return $file->storeAs('uploads', $img_name, 'public');
        return $file->storeAs('images/'.$name, $name.'.'.$extension , 'public');

 }
     public static function UploadSliderImage($file , $name) {
         $extension = $file->extension();
//       return $file->storeAs('uploads', $img_name, 'public');
         return $file->storeAs('sliders/', $name, 'public');

     }
     public static function UploadPaymentImage($file , $name) {
         $extension = $file->extension();
//       return $file->storeAs('uploads', $img_name, 'public');
         return $file->storeAs('payments/'.$name, $name.'.'.$extension , 'public');

     }
     public static function UploadVideoQuality($file , $name , $quality) {
         $extension = $file->extension();
//       return $file->storeAs('uploads', $img_name, 'public');
         return $file->storeAs('videos/'.$quality.$name, $name.'.'.$extension , 'public');

     }

     public static function UploadVideo($file , $slug  ) {
         $extension = $file->getClientOriginalExtension();
//       return $file->storeAs('uploads', $img_name, 'public');
         return $file->storeAs('videos/'.$slug, "video".'.'.$extension , 'public');

     }

     public static function UploadEpisode($file , $name ,$episodeName ) {
         $extension = $file->extension();
//       return $file->storeAs('uploads', $img_name, 'public');
         return $file->storeAs('videos/'.$name.'/'.$episodeName, "video".'.'.$extension , 'public');

     }


}
