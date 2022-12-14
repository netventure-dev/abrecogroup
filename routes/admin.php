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


  // size
  Route::get('size',  'Admin\SizeController@index')->name('size.index');
  Route::get('size/create',  'Admin\SizeController@create')->name('size.create');
  Route::post('size/store',  'Admin\SizeController@store')->name('size.store');
  Route::get('size/edit/{id}',  'Admin\SizeController@edit')->name('size.edit');
  Route::post('size/update/{id}',  'Admin\SizeController@update')->name('size.update');
  Route::delete('size/destroy/{id}',  'Admin\SizeController@destroy')->name('size.destroy');

  // Rods
  Route::get('rods',  'Admin\RodController@index')->name('rods.index');
  Route::get('rods/create',  'Admin\RodController@create')->name('rods.create');
  Route::post('rods/store',  'Admin\RodController@store')->name('rods.store');
  Route::get('rods/edit/{id}',  'Admin\RodController@edit')->name('rods.edit');
  Route::post('rods/update/{id}',  'Admin\RodController@update')->name('rods.update');
  Route::delete('rods/destroy/{id}',  'Admin\RodController@destroy')->name('rods.destroy');

  // Bundles
  Route::get('bundles',  'Admin\BundlesController@index')->name('bundles.index');
  Route::get('bundles/create',  'Admin\BundlesController@create')->name('bundles.create');
  Route::post('bundles/store',  'Admin\BundlesController@store')->name('bundles.store');
  Route::get('bundles/edit/{id}',  'Admin\BundlesController@edit')->name('bundles.edit');
  Route::post('bundles/update/{id}',  'Admin\BundlesController@update')->name('bundles.update');
  Route::delete('bundles/destroy/{id}',  'Admin\BundlesController@destroy')->name('bundles.destroy');

