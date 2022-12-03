<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdministratorController;

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


// Roles
Route::get('roles/index',  'Admin\RoleController@index')->name('roles.index');
Route::get('roles/create',  'Admin\RoleController@create')->name('roles.create');

// permissions
Route::get('permissions/index',  'Admin\PermissionController@index')->name('permissions.index');
Route::get('permissions/create',  'Admin\PermissionController@create')->name('permissions.create');
Route::post('permissions/store',  'Admin\PermissionController@store')->name('permissions.store');