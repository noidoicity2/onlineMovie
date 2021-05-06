<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\throwException;

class FileUntil
{
    public static function DeleteImageFromSlug($slug) {
        $files =     Storage::disk('public')->allFiles('images/'.$slug );
        try{
            foreach ($files as $file) {
                Storage::disk('public')->delete($file);
            }
            Storage::disk('public')->deleteDirectory('images/'.$slug );
        }

        catch (Exception $exception) {
            throwException($exception);
        }

    }
    public static  function  DeleteAllVideoFromSlug($slug) {
        $files =     Storage::disk('public')->allFiles('videos/'.$slug );
        try{
            foreach ($files as $file) {
                Storage::disk('public')->delete($file);
            }
            Storage::disk('public')->deleteDirectory('videos/'.$slug );
        }

        catch (Exception $exception) {
            throwException($exception);
        }

    }
}
