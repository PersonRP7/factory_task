<?php

use Illuminate\Support\Facades\Route;

use App\MyApiClient;


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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/entrypoint', function() {
//     return response()->json([
//         // 'name' => App\Helpers\Bridge::helloWorld(),
//         'name' => MyApiClient::helloWorld(),
//         'state' => 'CA',
//     ]);
// });

Route::get('/entrypoint', function() {
    return response()->json([
        // 'name' => App\Helpers\Bridge::helloWorld(),
        'name' => MyApiClient::category1(),
        'state' => 'CA',
    ]);
});

// Define a route, call a controller in the route,
// 


