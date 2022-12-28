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




  Route::get('why-choose-us/settings/create',  'Admin\ChooseSettingsController@create')->name('why-choose-us.settings.create');
  Route::post('why-choose-us/settings/store',  'Admin\ChooseSettingsController@store')->name('why-choose-us.settings.store');

  // testimonials
  Route::get('testimonials',  'Admin\TestimonialsController@index')->name('testimonials.index');
  Route::get('testimonials/create',  'Admin\TestimonialsController@create')->name('testimonials.create');
  Route::post('testimonials/store',  'Admin\TestimonialsController@store')->name('testimonials.store');
  Route::get('testimonials/edit/{id}',  'Admin\TestimonialsController@edit')->name('testimonials.edit');
  Route::post('testimonials/update/{id}',  'Admin\TestimonialsController@update')->name('testimonials.update');
  Route::delete('testimonials/destroy/{id}',  'Admin\TestimonialsController@destroy')->name('testimonials.destroy');

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



  // our-projects
  Route::get('our-projects',  'Admin\OurProjectsController@index')->name('our-projects.index');
  Route::get('our-projects/create',  'Admin\OurProjectsController@create')->name('our-projects.create');
  Route::post('our-projects/store',  'Admin\OurProjectsController@store')->name('our-projects.store');
  Route::get('our-projects/edit/{id}',  'Admin\OurProjectsController@edit')->name('our-projects.edit');
  Route::post('our-projects/update/{id}',  'Admin\OurProjectsController@update')->name('our-projects.update');
  Route::delete('our-projects/destroy/{id}',  'Admin\OurProjectsController@destroy')->name('our-projects.destroy');
