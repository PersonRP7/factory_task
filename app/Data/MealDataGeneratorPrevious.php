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

    public static function statusSetter($callable, $unixTimestamp)
    {
        $timeStamp = call_user_func($callable, $unixTimestamp);
        return $timeStamp;
    }

    // public static function statusGetter($queryParam)
    // {
    //     if ($queryParam == 'created')
    //     {
    //         return Meal::whereNull('deleted_at')->get();
    //     }
    //     if ($queryParam == 'updated')
    //     {
    //         // return Meal::whereNot('created_at', '=', 'updated_at')->get();
    //         return Meal::whereColumn('updated_at', '>', 'created_at')->get();
    //     }
    // }
    public static function statusGetter($queryParam)
    {
        if ($queryParam == 'created')
        {
            return Meal::whereNull('deleted_at')->get();
        }
        if (ctype_digit($queryParam))
        {
            $carbonObject = Carbon::createFromTimestamp($queryParam);
            $params = ["created_at", "updated_at", "deleted_at"];
            foreach ($params as $param) {
                foreach (Meal::all() as $meal) {
                    if ($meal->$param > $carbonObject) {
                        echo $meal;
                        // Return this
                    }
                }
            }       
        }
        // $carbonObject = Carbon::createFromTimestamp($unixTimestamp);
        // return $cls::whereDate($time_stamp, '<', $carbonObject)->get();   
    }

    // 1493902343
    // 1697902398
    public static function getStrFromUnixT($unixTimestamp)
    {
        return Carbon::createFromTimestamp($unixTimestamp)->toDateTimeString(); 
    }

    // Splits a comma delimited string. Fetches tags / with
    // public static function splitter($request, $stringData)
    // {
    //     return explode(',', $stringData);
    // }
    public static function splitter($request, $stringData)
    {
        return explode(',', $request->query($stringData));
    }

    public static function paramGetter($request, $name)
    {
        return $request->query($name);
    }

    #returns only one Meal object.
    public static function scopeByTag($ids)
    {
        $query = Meal::whereHas('tags', function($query) use ($ids) {$query->where('tag_id', $ids);});
        foreach ($ids as $id) {
            $query->whereHas('tags', fn ($query) => $query->where('tag_id', $id));
        }
        return $query->first();
    }

    // public static function getByTag($request)
    // {
    //     $tag_ids = explode(',', $request->query('tags'));;
    //     $meals = [];
    //     $data = Meal::wherehas('tags', function ($query) use($tag_ids) {$query->wherein('tag_id', $tag_ids);})->get();
    //     foreach ($data as $d) {
    //         array_push($meals, $d);
    //     }
    
    //     foreach ($meals as $meal) {
    //         if($meal->tags->count() == count($tag_ids))
    //         {
    //             return $meal;
    //         }
    //     }
    // }

    public static function getByTag($request, $lang, $diffTime)
    {
        $tag_ids = explode(',', $request->query('tags'));
        $meals = [];
        $data = Meal::wherehas('tags', function ($query) use($tag_ids) {$query->wherein('tag_id', $tag_ids);})->get();
        foreach ($data as $d) {
            $d->title = $d->title . " na " . $lang . " jeziku ";
            $d->description = $d->description . " na " . $lang . " jeziku ";
            array_push($meals, $d);
            // array_push($meals, $diffTime);
        }
    
        foreach ($meals as $meal) {
            if($meal->tags->count() == count($tag_ids))
            {
                return $meal;
                // return $diffTime;
            }
        }
    }

    public static function main($request)
    {
        $lang = MealDataGenerator::paramGetter($request, "lang");
        $tags = MealDataGenerator::splitter($request, "tags");
        $diffTime = $request->query("diff_time");
        $meals = MealDataGenerator::getByTag($request, $lang, $diffTime);
        // return $meals;
        // return $meals->toJson();
        return $meals;
    
    }

    #per_page, page, category, tags, with, lang*, diff_time
    // public static function main($request)
    // {
    //     $lang = MealDataGenerator::paramGetter($request, "lang");
    //     $tags = MealDataGenerator::splitter($request, "tags");
    //     foreach ($tags as $tag) {
    //         echo $tag;
    //     }
    //     echo $lang;
    // }
}
