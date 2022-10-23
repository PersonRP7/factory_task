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
