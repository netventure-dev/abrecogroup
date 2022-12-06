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

  // Admin
  Route::get('administrators',  'Admin\AdministratorController@index')->name('administrator.index');
  Route::get('administrators/create',  'Admin\AdministratorController@create')->name('administrator.create');
  Route::post('administrators/store',  'Admin\AdministratorController@store')->name('administrator.store');
  Route::get('administrators/edit/{id}',  'Admin\AdministratorController@edit')->name('administrator.edit');
  Route::post('administrators/update/{id}',  'Admin\AdministratorController@update')->name('administrator.update');
  Route::delete('administrators/destroy/{id}',  'Admin\AdministratorController@destroy')->name('administrator.destroy');

  // Sales Difficulty
  Route::get('sales-difficulty',  'Admin\SalesDifficultyController@index')->name('sales-difficulty.index');
  Route::get('sales-difficulty/create',  'Admin\SalesDifficultyController@create')->name('sales-difficulty.create');
  Route::post('sales-difficulty/store',  'Admin\SalesDifficultyController@store')->name('sales-difficulty.store');
  Route::get('sales-difficulty/edit/{id}',  'Admin\SalesDifficultyController@edit')->name('sales-difficulty.edit');
  Route::post('sales-difficulty/update/{id}',  'Admin\SalesDifficultyController@update')->name('sales-difficulty.update');
  Route::delete('sales-difficulty/destroy/{id}',  'Admin\SalesDifficultyController@destroy')->name('sales-difficulty.destroy');

  // Brands
  Route::get('brands',  'Admin\BrandController@index')->name('brands.index');
  Route::get('brands/create',  'Admin\BrandController@create')->name('brands.create');
  Route::post('brands/store',  'Admin\BrandController@store')->name('brands.store');
  Route::get('brands/edit/{id}',  'Admin\BrandController@edit')->name('brands.edit');
  Route::post('brands/update/{id}',  'Admin\BrandController@update')->name('brands.update');
  Route::delete('brands/destroy/{id}',  'Admin\BrandController@destroy')->name('brands.destroy');

// Roles
Route::get('roles/index',  'Admin\RoleController@index')->name('roles.index');
Route::get('roles/create',  'Admin\RoleController@create')->name('roles.create');

// permissions
Route::get('permissions/index',  'Admin\PermissionController@index')->name('permissions.index');
Route::get('permissions/create',  'Admin\PermissionController@create')->name('permissions.create');
Route::post('permissions/store',  'Admin\PermissionController@store')->name('permissions.store');

//Sales difficulty
Route::get('kms/index',  'Admin\KmsController@index')->name('kms.index');
Route::get('kms/create',  'Admin\KmsController@create')->name('kms.create');
Route::post('kms/store',  'Admin\KmsController@store')->name('kms.store');
Route::get('kms/edit/{id}',  'Admin\KmsController@edit')->name('kms.edit');
Route::post('kms/update/{id}',  'Admin\KmsController@update')->name('kms.update');
Route::delete('kms/destroy/{id}',  'Admin\KmsController@destroy')->name('kms.destroy');

//fuel type
Route::resource('fuel','Admin\FuelTypeController');