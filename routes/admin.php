<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\SalesDifficultyController;


Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');


  // home slider
  Route::get('home-slider',  'Admin\HomeSliderController@index')->name('home-slider.index');
  Route::get('home-slider/create',  'Admin\HomeSliderController@create')->name('home-slider.create');
  Route::post('home-slider/store',  'Admin\HomeSliderController@store')->name('home-slider.store');
  Route::get('home-slider/edit/{id}',  'Admin\HomeSliderController@edit')->name('home-slider.edit');
  Route::post('home-slider/update/{id}',  'Admin\HomeSliderController@update')->name('home-slider.update');
  Route::delete('home-slider/destroy/{id}',  'Admin\HomeSliderController@destroy')->name('home-slider.destroy');

  // why choose us.list
  Route::get('why-choose-us/list',  'Admin\ChooseController@index')->name('why-choose-us.list.index');
  Route::get('why-choose-us/list/create',  'Admin\ChooseController@create')->name('why-choose-us.list.create');
  Route::post('why-choose-us/list/store',  'Admin\ChooseController@store')->name('why-choose-us.list.store');
  Route::get('why-choose-us/list/edit/{id}',  'Admin\ChooseController@edit')->name('why-choose-us.list.edit');
  Route::post('why-choose-us/list/update/{id}',  'Admin\ChooseController@update')->name('why-choose-us.list.update');
  Route::delete('why-choose-us/list/destroy/{id}',  'Admin\ChooseController@destroy')->name('why-choose-us.list.destroy');

  // why choose us.settings
  Route::get('why-choose-us/settings',  'Admin\ChooseController@index')->name('why-choose-us.settings.index');
  Route::get('why-choose-us/settings/create',  'Admin\ChooseController@create')->name('why-choose-us.settings.create');
  Route::post('why-choose-us/settings/store',  'Admin\ChooseController@store')->name('why-choose-us.settings.store');
  Route::get('why-choose-us/settings/edit/{id}',  'Admin\ChooseController@edit')->name('why-choose-us.settings.edit');
  Route::post('why-choose-us/settings/update/{id}',  'Admin\ChooseController@update')->name('why-choose-us.settings.update');
  Route::delete('why-choose-us/settings/destroy/{id}',  'Admin\ChooseController@destroy')->name('why-choose-us.settings.destroy');

//blog settings
Route::get('blog-settings/create',  'Admin\BlogSettingController@create')->name('blog-settings.create');
Route::post('blog-settings/store',  'Admin\BlogSettingController@store')->name('blog-settings.store');

//blog list
Route::get('blog/list',  'Admin\BlogListController@index')->name('blog-list.index');
Route::get('blog/list/create',  'Admin\BlogListController@create')->name('blog-list.create');
Route::post('blog/list/store',  'Admin\BlogListController@store')->name('blog-list.store');
Route::get('blog/list/edit/{id}',  'Admin\BlogListController@edit')->name('blog-list.edit');
Route::post('blog/list/update/{id}',  'Admin\BlogListController@update')->name('blog-list.update');
Route::delete('blog/list/destroy/{id}',  'Admin\BlogListController@destroy')->name('blog-list.destroy');




