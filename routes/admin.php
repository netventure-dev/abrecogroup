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
  Route::get('schedule',  'Admin\ScheduleController@index')->name('schedule.index');
  Route::get('schedule/create',  'Admin\ScheduleController@create')->name('schedule.create');
  Route::post('schedule/store',  'Admin\ScheduleController@store')->name('schedule.store');
  Route::get('schedule/edit/{id}',  'Admin\ScheduleController@edit')->name('schedule.edit');
  Route::post('schedule/update/{id}',  'Admin\ScheduleController@update')->name('schedule.update');
  Route::delete('schedule/destroy/{id}',  'Admin\ScheduleController@destroy')->name('schedule.destroy');


