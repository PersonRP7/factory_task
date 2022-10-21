<?php
namespace App\Data;

// use App\Data\MealDataGenerator;

use App\Models\Meal;
use Carbon\Carbon;

class MealDataGenerator
{
    public static function diffTimeComparison($queryParameter)
    {
        if (!ctype_digit($queryParameter))
        {
            return false;
        }
        // return true;

    }

    // 1493902343
    public static function getStrFromUnixT($unixTimestamp)
    {
        return Carbon::createFromTimestamp($unixTimestamp)->toDateTimeString(); 
    }

    public static function ls($cls)
    {
        return $cls::all();
    }
}
