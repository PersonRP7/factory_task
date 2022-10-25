<?php
namespace App\Data;

// use App\Data\MealDataGenerator;

use App\Models\Meal;
use Carbon\Carbon;
use App\Models\Ingredients;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Language;


class MealDataGenerator
{
  

    public static function byTag($request)
    {

        $tag_ids = explode(',', $request->query('tags'));

        //meals holds the Meal item keys
        $meals = [];
        //meals holds the Meal item keys

        $meal_ids_duplicates = [];
        $data = [];
        
        foreach ($tag_ids as $id) {
            $res = Meal::whereHas('tags', function($query) use ($id) {$query->where('tag_id', $id);})->first();
            array_push($meals, $res);
        }
        // return $meals;
        foreach ($meals as $meal) {
            array_push($meal_ids_duplicates, $meal->id);
        }
        $meals_unique = array_unique($meal_ids_duplicates);
        
        foreach ($meals_unique as $key) {
            $data_loop = Meal::query()

            ->whereHas('tags', function ($query) use ($tag_ids, $key ) {

            $query->whereIn('tag_id', $tag_ids );
            }, count($tag_ids))
            ->where('id', $key )
            ->get();
            array_push($data, $key);
        }
        return $data;
    }

    public static function paramGetter($request, $name)
    {
        return $request->query($name);
    }

    public static function byDiffTime($request)
    {
        //receive arg, return true or false;
    }

    // 1493902343
    // 1697902398

    public static function statusDecorator($instance, $queryParam)
    {
        if ($queryParam == 'created')
        {
            return $instance->status;
        }
        if (ctype_digit($queryParam))
        {
            $carbonObject = Carbon::createFromTimestamp($queryParam);
            $params = ["created_at", "updated_at", "deleted_at"];
            foreach ($params as $param) {
                
                if ($instance->$param > $carbonObject) {
                    return substr($param, 0, -3);
                }
                
            }       
        }
    }
  
    public static function idDecorator($instance)
    {
        return $instance->id . " decorated";
    }

    //title and description
    public static function langDecorator($instance, $lang, $field)
    {
        if (Language::where('code', $lang)->exists())
        {
            return $instance->$field . " {$lang}";
        }
        return $instance->$field;
    }

    #Many to many decorator
    public static function mtmDecorator($id, $relation)
    {
        $mtmArray = [];
        // $meal = Meal::first();
        $data = Meal::where('id', $id)->first();
        foreach ($data->$relation as $rel) {
            array_push($mtmArray, [
                "id" => $rel->id,
                "title" => $rel->title,
                "slug" => $rel->slug
            ]);
        }
        return $mtmArray;
    }

    public static function metaMaker($request)
    {
        $meta = [];
        $totalItems = count(MealDataGenerator::byTag($request));
        $perPage = MealDataGenerator::paramGetter($request, "per_page");
        $totalPages = floor(($totalItems + $perPage - 1) / $perPage);
        array_push($meta, [
            "total_items"=> $totalItems,
            "per_page" => $perPage,
            "total_pages" => $totalPages
        ]);
        return $meta;
    }

    public static function categoryDecorator($id)
    {
        $categoryArray = [];
        $meal = Meal::where('id', $id)->first();

        if ($meal->category == null)
        {return null;}
            array_push($categoryArray, [
                "id" => $meal->category->id,
                "title" => $meal->category->title,
                "slug" => $meal->category->slug,
            ]);

        return $categoryArray;
    }


    public static function main($request)
    {

        $meals = [];
        $meals_localized = [];
        $lang = MealDataGenerator::paramGetter($request, "lang");
        $diffTime = MealDataGenerator::paramGetter($request, "diff_time");
        
        // foreach (MealDataGenerator::byTag($request) as $key) {
        //     array_push($meals, Meal::where('id', $key)->get());
        // }
        foreach (MealDataGenerator::byTag($request) as $key) {
            // array_push($meals, Meal::where('id', $key)->get());
            foreach (Meal::where('id', $key)->get() as $instance) {
                // array_push($meals, $instance->title);
                array_push($meals, [
                    // "id" => $instance->id,
                    "id" => MealDataGenerator::idDecorator($instance),
                    "title" => MealDataGenerator::langDecorator($instance, $lang, "title"),
                    "description" => MealDataGenerator::langDecorator($instance, $lang, "description"),
                    "status" => MealDataGenerator::statusDecorator($instance, $diffTime),
                    "tags" => MealDataGenerator::mtmDecorator($instance->id, "tags"),
                    "ingredients" => MealDataGenerator::mtmDecorator($instance->id, "ingredients"),
                    "category" => MealDataGenerator::categoryDecorator($instance->id),
                ]);
            }
        }
    
        // foreach($meals as &$item) {
        //     unset($item['tags']);
        // }
         // meta array
         array_push($meals, [
            "meta" => MealDataGenerator::metaMaker($request)
            ]);
        // meta array

    return $meals;
    // return count(MealDataGenerator::byTag($request));
      
    }

}
