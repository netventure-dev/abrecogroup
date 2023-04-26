<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\IndustryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/home', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('industries',[IndustryController::class,'index']);
Route::get('industries/{uuid}',[IndustryController::class,'details']);
// Route::resource('home', HomeController::class);

