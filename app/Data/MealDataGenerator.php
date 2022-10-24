<?php
namespace App\Data;

// use App\Data\MealDataGenerator;

use App\Models\Meal;
use Carbon\Carbon;
use App\Models\Ingredients;
use App\Models\Tag;
use App\Models\Category;

// $tag_ids = [1,3,7,n];

// $meal_id = 7;

// $meals = Meal::query()

// ->whereHas('tags', function ($query) use ($tag_ids ) {

// $query->whereIn('id', $tag_ids );

// }, count($tag_ids))

// ->where('meal_id', $meal_id )

// ->get()

// ;

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

    // public static function main($request)
    // {

    //     $meals = [];
    //     $meals_localized = [];
    //     $lang = MealDataGenerator::paramGetter($request, "lang");
        
    //     foreach (MealDataGenerator::byTag($request) as $key) {
    //         array_push($meals, Meal::where('id', $key)->get());
    //     }
        
    //     foreach ($meals as $key) {
    //         foreach ($key as $k) {
    //             $k->title = $k->title . $lang;
    //             $k->description = $k->description . $lang;
    //             ///////
    //             // if ($k->status == "created")
    //             if($k->title == 'meal1de')
    //             {
    //                 $k->title = "MEAL CHANGED";
    //             }
    //             ///////
    //         }
    //        echo $key->toJson();
    //     }
        
        
    // }

    public static function idDecorator($instance)
    {
        return $instance->id . " decorated";
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

    public static function tagDecorator($id)
    {
        $tagArray = [];
        // $meal = Meal::first();
        $meal = Meal::where('id', $id)->first();
        foreach ($meal->tags as $tag) {
            array_push($tagArray, [
                "id" => $tag->id,
                "title" => $tag->title,
                "slug" => $tag->slug
            ]);
        }
        return $tagArray;
    }

    public static function main($request)
    {

        $meals = [];
        $meals_localized = [];
        $lang = MealDataGenerator::paramGetter($request, "lang");
        
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
                    "title" => $instance->title,
                    "description" => $instance->description,
                    // "tags" => array("key" => "value")
                    // "tags" => MealDataGenerator::tagDecorator($instance->id)
                    "tags" => MealDataGenerator::mtmDecorator($instance->id, "tags"),
                    "ingredients" => MealDataGenerator::mtmDecorator($instance->id, "ingredients"),
                ]);
            }
        }
    
        // foreach($meals as &$item) {
        //     unset($item['tags']);
        // }

    return $meals;
    // foreach ($meals as $key => $value) {
    //     print_r($value);
    //     foreach ($value as $v) {
    //         print_r($v);
    //     }
    // }
      
    }

}
