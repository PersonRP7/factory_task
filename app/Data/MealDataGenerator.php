<?php
namespace App\Data;

// use App\Data\MealDataGenerator;

use App\Models\Meal;
use Carbon\Carbon;

class MealDataGenerator
{
   
    //  Meal::whereDate('created_at', '<', $t1)->get();

    //unixTimestamp = 1493902343
    //$cls = 'Meal'
    //$time_stamp = 'created_at', 'updated_at', 'deleted_at'
    public static function diffTimeComparison($unixTimestamp, $cls, $time_stamp)
    {
        if (!ctype_digit($unixTimestamp))
        {
            return false;
        }
        $carbonObject = Carbon::createFromTimestamp($unixTimestamp);
        return $cls::whereDate($time_stamp, '<', $carbonObject)->get();
    }

    // 1493902343
    // 1697902398
    public static function getStrFromUnixT($unixTimestamp)
    {
        return Carbon::createFromTimestamp($unixTimestamp)->toDateTimeString(); 
    }

    public static function ls($cls)
    {
        return $cls::all();
    }
}
