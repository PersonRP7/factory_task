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


// Route::get('user/{name?}', function ($name=null) {  
//     return $name;  
// });  

// Route::get('with/{with?}', function ($with=null) {  
//     // return $with;
//     $values = explode(',', $with);
//     return $values;  
// });  

// Route::get('with/{with?}', function ($with=null) {  
//     // return $with;
//     $values = explode(',', $with);
//     return $values;  
// });  

// Route::get('/per_page/{per_page?}/tags/{tags?}/', 
// function ($per_page=null, $tags=null) 
// {  
//     $tags = explode(',', $tags);
//     return $tags;
//     // $values = explode(',', $with);
//     // return $values;

// });  

// Route::get('/per_page/{per_page?}/tags/{tags?}/', 
// function ($per_page=null, $tags=null) 
// {  
//     // $tags = explode(',', $tags);
//     // return $tags;
//     return "text";
//     // $values = explode(',', $with);
//     // return $values;

// });  

// Route::get('/user/{name?}', function ($name = null) {
//     return $name;
// });

// Route::get('/user/{name?}/surname/{surname?}/', function ($name = null, $surname = null) {
//     return $name;
// });

// Route::get('/user/{name?}/surname/{surname?}/', function ($name = null, $surname = null) {
//     return "text";
// });

// Route::get('/{params}', 'App\Http\Controllers\MealController@index')
// ->where('params', '.*');

// Route::get('/name/{name?}/keys/{keys?}', function($name = null, $keys = null){
//     return $keys;
// });

// Route::get('name/{name?}', function ($name=null) {  
//         return $name;  
// });  

// Route::get('name/{name?}/keys/{keys?}', function ($name=null, $keys=null) {  
//     return $name;  
// });  

// Route::get('/name/{name?}/keys/{keys?}', function ($name=null, $keys=null) {  
//     return $name;  
// });  

// Route::get('/lang/{lang}/keys/{keys?}', function ($lang, $keys=null) {  
//     return $keys;  
// });  

// Route::get('/', function() {
//     return "Hello World";
// });

// Route::get('/', MealController::class);
// Route::get('/', 'App/Http/Controllers/MealController');
// Route::get('/', 'App/Http/Controllers/MealController@index')->name('meal');
// Route::get('/', 'App\Http\Controllers\MealController');

// Route::controller(MealController::class);

Route::resource('/', MealController::class);

