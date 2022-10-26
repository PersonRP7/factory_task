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


Route::resource('/', MealController::class);

use App\Models\Meal;
use App\Models\Tag;


use Illuminate\Http\Request;
use App\Data\MealDataGenerator;
use Carbon\Carbon;

Route::any('/ten', function (Request $request) {
    // return $request->query('diff_time');
    $ids = [];
    $diff_time = $request->query("diff_time");
    $carbonObject = Carbon::createFromTimestamp($diff_time);
    foreach (Meal::all() as $meal) {
        if ($meal->updated_at > $carbonObject) {
            array_push($ids, $meal->id);
        }
    }
    return $ids;
});



