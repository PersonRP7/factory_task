<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MealController;
use App\Http\Controllers\MealController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', MealController::class);

use App\Models\Meal;
use App\Models\Tag;

// Route::get('/one/{lang}', function($lang) {
//     $meal1 = Meal::first();
//     $meal1->title = "Changed title" . $lang;
//     return $meal1;
// });

// Route::get('/two', function() {
//     // Meal::whereHas(‘tags’, function ($query) { $query->where(‘id’, 1)})
//     // $query = Meal::whereHas('tags', function($query) {$query->where('tag_id', 1);});
//     // return $query;
//     $ids = [1, 2, 3];
//     $mls = [];
//     foreach ($ids as $id) {
//         $res = Meal::whereHas('tags', function($query) {$query->where('tag_id', $id);})->first();
//         array_push($mls, $res);
//     }
//     return $mls;
// });

Route::get('/two', function() {
    // Meal::whereHas(‘tags’, function ($query) { $query->where(‘id’, 1)})
    // $query = Meal::whereHas('tags', function($query) {$query->where('tag_id', 1);});
    // return $query;
    $ids = [3, 2, 1];
    $meals = [];
    foreach ($ids as $id) {
        $res = Meal::whereHas('tags', function($query) use ($id) {$query->where('tag_id', $id);})->first();
        array_push($meals, $res);
    }
    return $meals;
});

// Route::get('/two', function() {
//     // meal::wherehas(‘tags’, function ($query) { $query->wherein(‘id’, $tags)});
//     $tags = [1,2,3];
//     $mls = [];
//     foreach ($ids as $id) {
//         $res = Meal::whereHas('tags', function($query) use ($id) {$query->where('tag_id', $id);})->first();
//         array_push($mls, $res);
//     }
//     return $res;
// });

// Route::get('/three', function() {
//     $id=[1,2,3];
//     $data = Meal::where(function($query)use($id){
//         foreach ($id as $value){
//             $query->whereHas('tags',function ($query)use($value){

//                 $query->where('tag_id',$value);


//             });
//         }


//     })->get();
//     echo $data;
// });

// use App\Models\Tag;
// Route::get('/four', function() {
//     $tag_ids = [1, 2, 3];
//     $meal_ids = [];
//     foreach (Meal::all() as $meal) {
//         array_push($meal_ids, $meal->id);
//     }
//     // print_r($meal_ids);

// });

// Route::get('/four', function() {
//     $tag_ids = [1, 2, 3];
//     $meal_ids = [];
//     // Tag::whereHas('meals', function($query){return $query->where('meal_id', 7);})->get();
//     foreach ($tag_ids as $tag) {
        
//     }
// });

// Route::get('/four', function() {
//     // meal::wherehas(‘tags’, function ($query) { $query->wherein(‘id’, $tags)});
//     $tag_ids = [1, 2, 3];
//     $mls = [];
//     foreach ($tag_ids as $id) {
//         $res = Meal::whereHas('tags', function($query) use ($id) {$query->where('tag_id', $id);})->first();
//         array_push($mls, $res);
//     }
//     return $mls;
// });

// meal::wherehas(‘tags’, function ($query) { $query->wherein(‘id’, $tags)});
// Route::get('/four', function() {
//     // meal::wherehas(‘tags’, function ($query) { $query->wherein(‘id’, $tags)});
//     $tag_ids = [1, 2, 3];
//     $meals = [];
//     $data = Meal::wherehas('tags', function ($query) use($tag_ids) {$query->wherein('tag_id', $tag_ids);})->get();
//     foreach ($data as $d) {
//         array_push($meals, $d);
//     }
    
//     foreach ($meals as $meal) {
//         echo $meal;
//     }
//     // return $data;
// });

// Route::get('/four', function() {
//     // meal::wherehas(‘tags’, function ($query) { $query->wherein(‘id’, $tags)});
//     $tag_ids = [1, 2, 3];
//     $meals = [];
//     $data = Meal::wherehas('tags', function ($query) use($tag_ids) {$query->wherein('tag_id', $tag_ids);})->get();
//     foreach ($data as $d) {
//         array_push($meals, $d);
//     }

//     foreach ($meals as $meal) {
//         if($meal->tags->count() == count($tag_ids))
//         {
//             print_r($meal);
//         }
//     }
//     // return $data;
// });

// Route::get('/four', function() {
//     // meal::wherehas(‘tags’, function ($query) { $query->wherein(‘id’, $tags)});
//     $meal = Meal::where('id', 4)->first();
//     return $meal->tags->count();
// });
