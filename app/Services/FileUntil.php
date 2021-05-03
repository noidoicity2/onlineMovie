<?php


namespace App\Services;


use function PHPUnit\Framework\throwException;

class FileUntil
{
    public static function DeleteFileFromUrl($path) {
        try{
            $pos = strrpos($path , '/');
            $a = substr($path, 0,$pos);
            unlink(public_path($path));
            rmdir(public_path($a));
        }
        catch (\Exception $e) {
//            throw new \Exception("canot delete file");
//            return true;
        }

    }
}
