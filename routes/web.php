<?php

use Illuminate\Support\Facades\Route;
use App\Models\Service;
use Illuminate\Http\Request;

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

Route::get('/', 'HomeController@index')->name('home');

// calculation

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});


//feedback
Route::get('feedback', 'FeedbackController@index')->name('feedback.index');
Route::post('feedback/store', 'FeedbackController@store')->name('feedback.store');

//contact-us
Route::get('contact-us', 'ContactController@index')->name('contact-us.index');
Route::post('contact-us/store', 'ContactController@store')->name('contact-us.store');


//request a quote
Route::get('request-a-quote', 'RequestQuoteController@index')->name('request-a-quote.index');
Route::post('request-a-quote/store', 'RequestQuoteController@store')->name('request-a-quote.store');

// services

Route::get('{slug}','ServiceController@index')->name('service.index');