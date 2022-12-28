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
  Route::get('why-choose-us/list',  'Admin\ChooseListController@index')->name('why-choose-us.list.index');
  Route::get('why-choose-us/list/create',  'Admin\ChooseListController@create')->name('why-choose-us.list.create');
  Route::post('why-choose-us/list/store',  'Admin\ChooseListController@store')->name('why-choose-us.list.store');
  Route::get('why-choose-us/list/edit/{id}',  'Admin\ChooseListController@edit')->name('why-choose-us.list.edit');
  Route::post('why-choose-us/list/update/{id}',  'Admin\ChooseListController@update')->name('why-choose-us.list.update');
  Route::delete('why-choose-us/list/destroy/{id}',  'Admin\ChooseListController@destroy')->name('why-choose-us.list.destroy');

  // why choose us.settings
  Route::get('why-choose-us/settings',  'Admin\ChooseController@index')->name('why-choose-us.settings.index');
  Route::get('why-choose-us/settings/create',  'Admin\ChooseController@create')->name('why-choose-us.settings.create');
  Route::post('why-choose-us/settings/store',  'Admin\ChooseController@store')->name('why-choose-us.settings.store');
  Route::get('why-choose-us/settings/edit/{id}',  'Admin\ChooseController@edit')->name('why-choose-us.settings.edit');
  Route::post('why-choose-us/settings/update/{id}',  'Admin\ChooseController@update')->name('why-choose-us.settings.update');
  Route::delete('why-choose-us/settings/destroy/{id}',  'Admin\ChooseController@destroy')->name('why-choose-us.settings.destroy');


  // services
  Route::get('services',  'Admin\ServiceController@index')->name('services.index');
  Route::get('services/create',  'Admin\ServiceController@create')->name('services.create');
  Route::post('services/store',  'Admin\ServiceController@store')->name('services.store');
  Route::get('services/edit/{id}',  'Admin\ServiceController@edit')->name('services.edit');
  Route::post('services/update/{id}',  'Admin\ServiceController@update')->name('services.update');
  Route::delete('services/destroy/{id}',  'Admin\ServiceController@destroy')->name('services.destroy');
  // service content
  Route::get('services/{id}/content',  'Admin\ServiceContentController@index')->name('services.content.index');
  Route::get('services/{id}/content/create',  'Admin\ServiceContentController@create')->name('services.content.create');
  Route::post('services/{id}/content/store',  'Admin\ServiceContentController@store')->name('services.content.store');
  Route::get('services/{id}/content/{uuid}/edit',  'Admin\ServiceContentController@edit')->name('services.content.edit');
  Route::post('services/{id}/content/{uuid}/update',  'Admin\ServiceContentController@update')->name('services.content.update');
  Route::post('services/{id}/content/{uuid}/destroy',  'Admin\ServiceContentController@destroy')->name('services.content.destroy');


