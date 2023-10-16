<?php

namespace App\Http\Helpers;

use App\Models\Config\Unit;
use Exception;

class Utility {
    public static function uploadFile($name, $path="uploads"): String {
        $fileName = time().'.'.request()->file($name)->extension();  
        $path = request()->file($name)->storeAs($path, $fileName, "public");
        return $path;
    }

    public static function convert(Unit $from, Unit $to, $quantity) {
        
        if ($from->id == $to->id) {
            return $quantity;
        }

        if ($from->unit_type_id != $to->unit_type_id) {
            throw new Exception("Error Converting Units of Different Types", 1);
        }

        $default_unit = Unit::where("unit_type_id", $from->unit_type_id)->where("factor", 1)->first();

        if (!$default_unit) {
            throw new Exception("Error The Unit Type Group does not have a default unit with factor = 1", 1);
        }

        $result = ($from->factor/$to->factor) * $quantity;

        return $result;
    }
}