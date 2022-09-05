<?php

namespace App\Http\Helpers;

class Utility {
    public static function uploadFile($name, $path="uploads"): String {
        $fileName = time().'.'.request()->file($name)->extension();  
        $path = request()->file($name)->storeAs($path, $fileName, "public");
        return $path;
    }
}