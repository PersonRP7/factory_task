<?php
namespace App\Data;

// use App\Data\MealDataGenerator;

use App\Models\Meal;
use Carbon\Carbon;

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

    public static function main($request)
    {

        return MealDataGenerator::byTag($request);
        // return "Hello World";
        
    }

}
