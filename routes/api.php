<?php

use App\Http\Controllers\Api\AboutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\IndustryController;
use App\Http\Controllers\Api\ServiceApiController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\ServiceFormController;
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
Route::get('/general', [HomeController::class, 'general']);
Route::get('industries',[IndustryController::class,'index']);
Route::get('industries/{uuid}',[IndustryController::class,'details']);
Route::get('/about-us', [AboutController::class, 'index']);
Route::get('/services', [ServiceApiController::class, 'index']);
Route::get('/service/level-1/{uuid}', [ServiceApiController::class, 'details']);
Route::get('/service/{uuid}/level-2/{id}', [ServiceApiController::class, 'sub_services']);
Route::get('/service/{uuid}/level-2/{id}/level-3/{idd}', [ServiceApiController::class, 'inner_services']);
Route::get('/blogs', [BlogApiController::class, 'index']);

// /sections
Route::get('/section_3_driven', [HomeController::class, 'section_3']);
Route::get('/section_5_Services', [HomeController::class, 'section_5']);
Route::get('/section_6_case', [HomeController::class, 'section_6']);
Route::get('/section_7_industries', [HomeController::class, 'section_7']);
Route::get('/section_8_why', [HomeController::class, 'section_8']);

// Serivce
Route::post('/service', [ServiceFormController::class, 'store']);


// Route::resource('home', HomeController::class);

