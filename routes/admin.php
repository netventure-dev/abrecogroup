<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\SalesDifficultyController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CareerOpeningController;

Route::get('/home', function () {
  $users[] = Auth::user();
  $users[] = Auth::guard()->user();
  $users[] = Auth::guard('admin')->user();

  //dd($users);

  return view('admin.home');
})->name('home');

//logout
Route::get('logout', 'AdminAuth\LoginController@logout')->name('logout');


// about us settings
Route::get('about us/settings/create',  'Admin\AboutUsController@create')->name('about-us.settings.create');
Route::post('about us/settings/store',  'Admin\AboutUsController@store')->name('about-us.settings.store');
Route::get('about-us/settings/image-delete',  'Admin\AboutUsController@image_delete')->name('about-us.settings.image_delete');
Route::get('about-us/settings/image-delete1',  'Admin\AboutUsController@image_delete1')->name('about-us.settings.image_delete1');

// about us list
Route::get('about-us/list',  'Admin\AboutUsListController@index')->name('about-us.list.index');
Route::get('about-us/list/create',  'Admin\AboutUsListController@create')->name('about-us.list.create');
Route::post('about-us/list/store',  'Admin\AboutUsListController@store')->name('about-us.list.store');
Route::get('about-us/list/edit/{id}',  'Admin\AboutUsListController@edit')->name('about-us.list.edit');
Route::post('about-us/list/update/{id}',  'Admin\AboutUsListController@update')->name('about-us.list.update');
Route::delete('about-us/list/destroy/{id}',  'Admin\AboutUsListController@destroy')->name('about-us.list.destroy');
Route::get('about-us/image-delete',  'Admin\AboutUsListController@image_delete')->name('about-us.image_delete');



// // Milestone settings
// Route::get('milestone/settings/create',  'Admin\MilestoneSettingsController@create')->name('milestone.settings.create');
// Route::post('milestone/settings/store',  'Admin\MilestoneSettingsController@store')->name('milestone.settings.store');
// Route::get('milestone/settings/image-delete',  'Admin\MilestoneSettingsController@image_delete')->name('milestone.settings.image_delete');
// // Route::get('about-us/settings/image-delete1',  'Admin\AboutUsController@image_delete1')->name('about-us.settings.image_delete1');


// // Milestone list
// // Route::get('milestone/list',  'Admin\MilestoneListController@index')->name('about-us.list.index');
// Route::get('milestone/list/create',  'Admin\MilestoneListController@create')->name('milestone.list.create');
// Route::post('milestone/list/store',  'Admin\MilestoneListController@store')->name('milestone.list.store');
// // Route::get('about-us/list/edit/{id}',  'Admin\AboutUsListController@edit')->name('about-us.list.edit');
// // Route::post('about-us/list/update/{id}',  'Admin\AboutUsListController@update')->name('about-us.list.update');
// // Route::delete('about-us/list/destroy/{id}',  'Admin\AboutUsListController@destroy')->name('about-us.list.destroy');
// // Route::get('about-us/image-delete',  'Admin\AboutUsListController@image_delete')->name('about-us.image_delete');


//  about us - mission and vision
Route::get('mission-vision',  'Admin\MissionVisionController@index')->name('mission-vision.index');
Route::get('mission-vision/create',  'Admin\MissionVisionController@create')->name('mission-vision.create');
Route::post('mission-vision/store',  'Admin\MissionVisionController@store')->name('mission-vision.store');
Route::get('mission-vision/edit/{id}',  'Admin\MissionVisionController@edit')->name('mission-vision.edit');
Route::post('mission-vision/update/{id}',  'Admin\MissionVisionController@update')->name('mission-vision.update');
Route::delete('mission-vision/destroy/{id}',  'Admin\MissionVisionController@destroy')->name('mission-vision.destroy');
Route::get('mission-vision/settings/image-delete',  'Admin\MissionVisionController@image_delete')->name('mission-vision.image_delete');
Route::get('mission-vision/settings/image-delete1',  'Admin\MissionVisionController@image_delete1')->name('mission-vision.image_delete1');





// home slider
 Route::get('home-slider',  'Admin\HomeSliderController@index')->name('home-slider.index');
Route::get('home-slider/create',  'Admin\HomeSliderController@create')->name('home-slider.create');
Route::post('home-slider/store',  'Admin\HomeSliderController@store')->name('home-slider.store');
Route::get('home-slider/edit/{id}',  'Admin\HomeSliderController@edit')->name('home-slider.edit');
Route::post('home-slider/update/{id}',  'Admin\HomeSliderController@update')->name('home-slider.update');
Route::delete('home-slider/destroy/{id}',  'Admin\HomeSliderController@destroy')->name('home-slider.destroy');
Route::get('home-slider/settings/image-delete',  'Admin\HomeSliderController@image_delete')->name('home-slider.image_delete');
Route::get('home-slider/settings/image-delete-one',  'Admin\HomeSliderController@image_delete_one')->name('home-slider.image_delete_one');

// Schema
Route::get('schema','Admin\SchemaController@index')->name('schema.index');
Route::post('schema/create','Admin\SchemaController@store')->name('schema.store');
Route::get('schema/{id}/update','Admin\SchemaController@update')->name('schema.update');

// why choose us list
Route::get('why-choose-us/list',  'Admin\ChooseListController@index')->name('why-choose-us.list.index');
Route::get('why-choose-us/list/create',  'Admin\ChooseListController@create')->name('why-choose-us.list.create');
Route::post('why-choose-us/list/store',  'Admin\ChooseListController@store')->name('why-choose-us.list.store');
Route::get('why-choose-us/list/edit/{id}',  'Admin\ChooseListController@edit')->name('why-choose-us.list.edit');
Route::post('why-choose-us/list/update/{id}',  'Admin\ChooseListController@update')->name('why-choose-us.list.update');
Route::delete('why-choose-us/list/destroy/{id}',  'Admin\ChooseListController@destroy')->name('why-choose-us.list.destroy');

// Additional pages
Route::get('additional_pages',  'Admin\AdditionalPagesController@index')->name('additional-pages.index');
Route::get('additional_pages/create',  'Admin\AdditionalPagesController@create')->name('additional-pages.create');
Route::post('additional_pages/store',  'Admin\AdditionalPagesController@store')->name('additional-pages.store');
Route::get('additional_pages/edit/{id}',  'Admin\AdditionalPagesController@edit')->name('additional-pages.edit');
Route::post('additional_pages/update/{id}',  'Admin\AdditionalPagesController@update')->name('additional-pages.update');
Route::delete('additional_pages/destroy/{id}',  'Admin\AdditionalPagesController@destroy')->name('additional-pages.destroy');
Route::get('additional_pages/image-delete',  'Admin\AdditionalPagesController@image_delete')->name('additional_pages.image_delete');
Route::get('additional_pages/image-delete1',  'Admin\AdditionalPagesController@image_delete1')->name('additional_pages.image_delete1');
Route::get('additional_pages/image-delete2',  'Admin\AdditionalPagesController@image_delete2')->name('additional_pages.image_delete2');



// why choose us settings
Route::get('why-choose-us/settings/create',  'Admin\ChooseSettingsController@create')->name('why-choose-us.settings.create');
Route::post('why-choose-us/settings/store',  'Admin\ChooseSettingsController@store')->name('why-choose-us.settings.store');

//blog settings
Route::get('blog-settings/create',  'Admin\BlogSettingController@create')->name('blog-settings.create');
Route::post('blog-settings/store',  'Admin\BlogSettingController@store')->name('blog-settings.store');
Route::get('blog-settings/image-delete',  'Admin\BlogSettingController@image_delete')->name('blog-settings.image_delete');
Route::get('blog-settings/image-delete_one',  'Admin\BlogSettingController@image_delete_one')->name('blog-settings.image_delete_one');


//case study settings
Route::get('case-study-settings/create',  'Admin\CaseStudySettingController@create')->name('case-study-settings.create');
Route::post('case-study-settings/store',  'Admin\CaseStudySettingController@store')->name('case-study-settings.store');
Route::get('case-study-settings/image-delete',  'Admin\CaseStudySettingController@image_delete')->name('case-study-settings.image_delete');
Route::get('case-study-settings/image-delete-one',  'Admin\CaseStudySettingController@image_delete_one')->name('case-study-settings.image_delete_one');
//blog list
Route::get('blog/list',  'Admin\BlogListController@index')->name('blog-list.index');
Route::get('blog/list/create',  'Admin\BlogListController@create')->name('blog-list.create');
Route::post('blog/list/store',  'Admin\BlogListController@store')->name('blog-list.store');
Route::get('blog/list/edit/{id}',  'Admin\BlogListController@edit')->name('blog-list.edit');
Route::post('blog/list/update/{id}',  'Admin\BlogListController@update')->name('blog-list.update');
Route::delete('blog/list/destroy/{id}',  'Admin\BlogListController@destroy')->name('blog-list.destroy');
Route::get('blog/list/image-delete',  'Admin\BlogListController@image_delete')->name('blog-list.image_delete');

// testimonials Settings

Route::get('testimonials-settings/create',  'Admin\TestimonialSettingsController@create')->name('testimonials-settings.create');
Route::post('testimonials-settings/store',  'Admin\TestimonialSettingsController@store')->name('testimonials-settings.store');



// Our Bussiness

Route::get('business-settings/create',  'Admin\OurBusinessSettingController@create')->name('business-settings.create');
Route::post('business-settings/store',  'Admin\OurBusinessSettingController@store')->name('business-settings.store');


//our business List

  Route::get('business-list','Admin\OurBuinessListController@logos')->name('business-list.index');
  Route::post('business-list/images', 'Admin\OurBuinessListController@store')->name('business-list.store');
  Route::delete('business-list/destroy/{id}',  'Admin\OurBuinessListController@destroy')->name('business-list.destroy');
  Route::post('business-list/title', 'Admin\OurBuinessListController@title')->name('business-list.title');
  

// testimonials
Route::get('testimonials',  'Admin\TestimonialsController@index')->name('testimonials.index');
Route::get('testimonials/create',  'Admin\TestimonialsController@create')->name('testimonials.create');
Route::post('testimonials/store',  'Admin\TestimonialsController@store')->name('testimonials.store');
Route::get('testimonials/edit/{id}',  'Admin\TestimonialsController@edit')->name('testimonials.edit');
Route::post('testimonials/update/{id}',  'Admin\TestimonialsController@update')->name('testimonials.update');
Route::delete('testimonials/destroy/{id}',  'Admin\TestimonialsController@destroy')->name('testimonials.destroy');
Route::get('testimonials/image-delete',  'Admin\TestimonialsController@image_delete')->name('testimonials.image_delete');


// sections
Route::get('sections',  'Admin\SectionController@index')->name('sections.index');
Route::get('sections/create',  'Admin\SectionController@create')->name('sections.create');
Route::post('sections/store',  'Admin\SectionController@store')->name('sections.store');
Route::get('sections/edit/{id}',  'Admin\SectionController@edit')->name('sections.edit');
Route::post('sections/update/{id}',  'Admin\SectionController@update')->name('sections.update');
Route::delete('sections/destroy/{id}',  'Admin\SectionController@destroy')->name('sections.destroy');
Route::get('sections/image-delete',  'Admin\SectionController@image_delete')->name('sections.image_delete');
Route::get('sections/image-delete1',  'Admin\SectionController@image_delete1')->name('sections.image_delete1');
Route::get('sections/image-delete2',  'Admin\SectionController@image_delete2')->name('sections.image_delete2');


// case studies
Route::get('case-study',  'Admin\CaseStudyController@index')->name('casestudies.index');
Route::get('case-study/create',  'Admin\CaseStudyController@create')->name('casestudies.create');
Route::post('case-study/store',  'Admin\CaseStudyController@store')->name('casestudies.store');
Route::get('case-study/edit/{id}',  'Admin\CaseStudyController@edit')->name('casestudies.edit');
Route::post('case-study/update/{id}',  'Admin\CaseStudyController@update')->name('casestudies.update');
Route::delete('case-study/destroy/{id}',  'Admin\CaseStudyController@destroy')->name('casestudies.destroy');
Route::get('case-study/change_service',  'Admin\CaseStudyController@change_service')->name('casestudies.change_service');
Route::get('case-study/change_subservice',  'Admin\CaseStudyController@change_subservice')->name('casestudies.change_subservice');
Route::get('case-study/image-delete',  'Admin\CaseStudyController@image_delete')->name('case-study.image_delete');
Route::get('case-study/image-delete1',  'Admin\CaseStudyController@image_delete1')->name('case-study.image_delete1');
Route::get('case-study/image-delete2',  'Admin\CaseStudyController@image_delete2')->name('case-study.image_delete2');

// case studies content
Route::get('case-study-contents/{id}',  'Admin\CaseStudyContentController@index')->name('casestudies.contents.index');
Route::get('case-study-contents/{id}/create',  'Admin\CaseStudyContentController@create')->name('casestudies.contents.create');
Route::post('case-study-contents/{id}/store',  'Admin\CaseStudyContentController@store')->name('casestudies.contents.store');
Route::get('case-study-contents/{id}/edit/{uuid}',  'Admin\CaseStudyContentController@edit')->name('casestudies.contents.edit');
Route::post('case-study-contents/{id}/update/{uuid}',  'Admin\CaseStudyContentController@update')->name('casestudies.contents.update');
Route::post('case-study-contents/{id}/destroy/{uuid}',  'Admin\CaseStudyContentController@destroy')->name('casestudies.contents.destroy');
Route::get('case-study-contents/image/delete',  'Admin\CaseStudyContentController@image_delete')->name('case-study-contents.image_delete');
Route::get('case-study-contents/image/delete1',  'Admin\CaseStudyContentController@image_delete_one')->name('case-study-contents.image_delete_one');


// section content
Route::get('sections/{id}/content',  'Admin\SectionContentController@index')->name('sections.content.index');
Route::get('sections/{id}/content/create',  'Admin\SectionContentController@create')->name('sections.content.create');
Route::post('sections/{id}/content/store',  'Admin\SectionContentController@store')->name('sections.content.store');
Route::get('sections/{id}/content/{uuid}/edit',  'Admin\SectionContentController@edit')->name('sections.content.edit');
Route::post('sections/{id}/content/{uuid}/update',  'Admin\SectionContentController@update')->name('sections.content.update');
Route::post('sections/{id}/content/{uuid}/destroy',  'Admin\SectionContentController@destroy')->name('sections.content.destroy');
Route::get('sections/content/image-delete',  'Admin\SectionContentController@image_delete')->name('sections.content.image_delete');



// services
Route::get('services',  'Admin\ServiceController@index')->name('services.index');
Route::get('services/create',  'Admin\ServiceController@create')->name('services.create');
Route::post('services/store',  'Admin\ServiceController@store')->name('services.store');
Route::get('services/edit/{id}',  'Admin\ServiceController@edit')->name('services.edit');
Route::post('services/update/{id}',  'Admin\ServiceController@update')->name('services.update');
Route::delete('services/destroy/{id}',  'Admin\ServiceController@destroy')->name('services.destroy');
Route::get('services/image-delete',  'Admin\ServiceController@image_delete')->name('services.image_delete');
Route::get('services/image-delete1',  'Admin\ServiceController@image_delete1')->name('services.image_delete1');


// service extras
Route::get('service/{uuid}/extra',  'Admin\ServiceExtraController@index')->name('services.extra.index');
Route::get('service/{uuid}/extra/create',  'Admin\ServiceExtraController@create')->name('services.extra.create');
Route::post('service/{uuid}/extra/store',  'Admin\ServiceExtraController@store')->name('services.extra.store');
Route::get('service/{id}/extra/{uuid}/edit',  'Admin\ServiceExtraController@edit')->name('services.extra.edit');
Route::post('service/{id}/extra/{uuid}/update',  'Admin\ServiceExtraController@update')->name('services.extra.update');
Route::post('service/{id}/extra/{uuid}/destroy',  'Admin\ServiceExtraController@destroy')->name('services.extra.destroy');
Route::get('services/extra/image-delete',  'Admin\ServiceExtraController@image_delete')->name('services.extra.image_delete');


// industries
Route::get('industries',  'Admin\IndustriesController@index')->name('industries.index');
Route::get('industries/create',  'Admin\IndustriesController@create')->name('industries.create');
Route::post('industries/store',  'Admin\IndustriesController@store')->name('industries.store');
Route::get('industries/edit/{id}',  'Admin\IndustriesController@edit')->name('industries.edit');
Route::post('industries/update/{id}',  'Admin\IndustriesController@update')->name('industries.update');
Route::delete('industries/destroy/{id}',  'Admin\IndustriesController@destroy')->name('industries.destroy');
Route::get('industries/image-delete', 'Admin\IndustriesController@image_delete')->name('industries.image_delete');
Route::get('industries/image-delete1', 'Admin\IndustriesController@image_delete1')->name('industries.image_delete1');

// industry content
Route::get('industries/{id}/content',  'Admin\IndustriesContentController@index')->name('industries.content.index');
Route::get('industries/{id}/content/create',  'Admin\IndustriesContentController@create')->name('industries.content.create');
Route::post('industries/{id}/content/store',  'Admin\IndustriesContentController@store')->name('industries.content.store');
Route::get('industries/{id}/content/{uuid}/edit',  'Admin\IndustriesContentController@edit')->name('industries.content.edit');
Route::post('industries/{id}/content/{uuid}/update',  'Admin\IndustriesContentController@update')->name('industries.content.update');
Route::post('industries/{id}/content/{uuid}/destroy',  'Admin\IndustriesContentController@destroy')->name('industries.content.destroy');
Route::get('industries//content/image-delete', 'Admin\IndustriesContentController@image_delete')->name('industries.content.image_delete');
Route::get('industries//content/image-delete1', 'Admin\IndustriesContentController@image_delete1')->name('industries.content.image_delete1');

// industry extra content
Route::get('industries/{id}/extra-content',  'Admin\IndustryExtraContentController@index')->name('industries.content.extra.index');
Route::get('industries/{id}/extra-content/create',  'Admin\IndustryExtraContentController@create')->name('industries.content.extra.create');
Route::post('industries/{id}/extra-content/store',  'Admin\IndustryExtraContentController@store')->name('industries.content.extra.store');
Route::get('industries/{id}/extra-content/{uuid}/edit',  'Admin\IndustryExtraContentController@edit')->name('industries.content.extra.edit');
Route::post('industries/{id}/extra-content/{uuid}/update',  'Admin\IndustryExtraContentController@update')->name('industries.content.extra.update');
Route::post('industries/{id}/extra-content/{uuid}/destroy',  'Admin\IndustryExtraContentController@destroy')->name('industries.content.extra.destroy');


// our-projects
Route::get('our-projects',  'Admin\OurProjectsController@index')->name('our-projects.index');
Route::get('our-projects/create',  'Admin\OurProjectsController@create')->name('our-projects.create');
Route::post('our-projects/store',  'Admin\OurProjectsController@store')->name('our-projects.store');
Route::get('our-projects/edit/{id}',  'Admin\OurProjectsController@edit')->name('our-projects.edit');
Route::post('our-projects/update/{id}',  'Admin\OurProjectsController@update')->name('our-projects.update');
Route::delete('our-projects/destroy/{id}',  'Admin\OurProjectsController@destroy')->name('our-projects.destroy');

// service content
Route::get('services/{id}/content',  'Admin\ServiceContentController@index')->name('services.content.index');
Route::get('services/{id}/content/create',  'Admin\ServiceContentController@create')->name('services.content.create');
Route::post('services/{id}/content/store',  'Admin\ServiceContentController@store')->name('services.content.store');
Route::get('services/{id}/content/{uuid}/edit',  'Admin\ServiceContentController@edit')->name('services.content.edit');
Route::post('services/{id}/content/{uuid}/update',  'Admin\ServiceContentController@update')->name('services.content.update');
Route::post('services/{id}/content/{uuid}/destroy',  'Admin\ServiceContentController@destroy')->name('services.content.destroy');
Route::get('services/content/image-delete',  'Admin\ServiceContentController@image_delete')->name('services.content.image_delete');
Route::get('services/content/image-delete1',  'Admin\ServiceContentController@image_delete1')->name('services.content.image_delete1');


// service faq
Route::get('services/{id}/faq',  'Admin\ServiceFaqController@index')->name('services.faq.index');
Route::get('services/{id}/faq/create',  'Admin\ServiceFaqController@create')->name('services.faq.create');
Route::post('services/{id}/faq/store',  'Admin\ServiceFaqController@store')->name('services.faq.store');
Route::get('services/{id}/faq/{uuid}/edit',  'Admin\ServiceFaqController@edit')->name('services.faq.edit');
Route::post('services/{id}/faq/{uuid}/update',  'Admin\ServiceFaqController@update')->name('services.faq.update');
Route::delete('services/{id}/faq/destroy',  'Admin\ServiceFaqController@destroy')->name('services.faq.destroy');

// sub services
Route::get('sub-services',  'Admin\SubServiceController@index')->name('sub-services.index');
Route::get('sub-services/create',  'Admin\SubServiceController@create')->name('sub-services.create');
Route::post('sub-services/store',  'Admin\SubServiceController@store')->name('sub-services.store');
Route::get('sub-services/edit/{id}',  'Admin\SubServiceController@edit')->name('sub-services.edit');
Route::post('sub-services/update/{id}',  'Admin\SubServiceController@update')->name('sub-services.update');
Route::delete('sub-services/destroy/{id}',  'Admin\SubServiceController@destroy')->name('sub-services.destroy');
Route::get('sub-services/image-delete',  'Admin\SubServiceController@image_delete')->name('sub-services.image_delete');
Route::get('sub-services/image-delete1',  'Admin\SubServiceController@image_delete1')->name('sub-services.image_delete1');

// inner services
Route::get('inner-services',  'Admin\InnerServiceController@index')->name('inner-services.index');
Route::get('inner-services/create',  'Admin\InnerServiceController@create')->name('inner-services.create');
Route::post('inner-services/store',  'Admin\InnerServiceController@store')->name('inner-services.store');
Route::get('inner-services/edit/{id}',  'Admin\InnerServiceController@edit')->name('inner-services.edit');
Route::post('inner-services/update/{id}',  'Admin\InnerServiceController@update')->name('inner-services.update');
Route::delete('inner-services/destroy/{id}',  'Admin\InnerServiceController@destroy')->name('inner-services.destroy');
Route::get('inner-services/image-delete',  'Admin\InnerServiceController@image_delete')->name('inner-services.image_delete');
Route::get('inner-services/image-delete1',  'Admin\InnerServiceController@image_delete1')->name('inner-services.image_delete1');

// inner service content
Route::get('inner-services/{id}/content',  'Admin\InnerServiceContentController@index')->name('inner-services.content.index');
Route::get('inner-services/{id}/content/create',  'Admin\InnerServiceContentController@create')->name('inner-services.content.create');
Route::post('inner-services/{id}/content/store',  'Admin\InnerServiceContentController@store')->name('inner-services.content.store');
Route::get('inner-services/{id}/content/{uuid}/edit',  'Admin\InnerServiceContentController@edit')->name('inner-services.content.edit');
Route::post('inner-services/{id}/content/{uuid}/update',  'Admin\InnerServiceContentController@update')->name('inner-services.content.update');
Route::post('inner-services/{id}/content/{uuid}/destroy',  'Admin\InnerServiceContentController@destroy')->name('inner-services.content.destroy');
Route::get('inner-services/content/image-delete',  'Admin\InnerServiceContentController@image_delete')->name('inner-services.content.image_delete');
Route::get('inner-services/content/image-delete1',  'Admin\InnerServiceContentController@image_delete1')->name('inner-services.content.image_delete1');


// inner service extras
Route::get('inner-service/{uuid}/extra',  'Admin\InnerServiceExtraController@index')->name('inner-services.extra.index');
Route::get('inner-service/{uuid}/extra/create',  'Admin\InnerServiceExtraController@create')->name('inner-services.extra.create');
Route::post('inner-service/{uuid}/extra/store',  'Admin\InnerServiceExtraController@store')->name('inner-services.extra.store');
Route::get('inner-service/{id}/extra/{uuid}/edit',  'Admin\InnerServiceExtraController@edit')->name('inner-services.extra.edit');
Route::post('inner-service/{id}/extra/{uuid}/update',  'Admin\InnerServiceExtraController@update')->name('inner-services.extra.update');
Route::post('inner-service/{id}/extra/{uuid}/destroy',  'Admin\InnerServiceExtraController@destroy')->name('inner-services.extra.destroy');
Route::get('inner-services/extra/image-delete',  'Admin\InnerServiceExtraController@image_delete')->name('inner-services.extra.image_delete');


// sub service content
Route::get('sub-services/{id}/content',  'Admin\SubServiceContentController@index')->name('sub-services.content.index');
Route::get('sub-services/{id}/content/create',  'Admin\SubServiceContentController@create')->name('sub-services.content.create');
Route::post('sub-services/{id}/content/store',  'Admin\SubServiceContentController@store')->name('sub-services.content.store');
Route::get('sub-services/{id}/content/{uuid}/edit',  'Admin\SubServiceContentController@edit')->name('sub-services.content.edit');
Route::post('sub-services/{id}/content/{uuid}/update',  'Admin\SubServiceContentController@update')->name('sub-services.content.update');
Route::post('sub-services/{id}/content/{uuid}/destroy',  'Admin\SubServiceContentController@destroy')->name('sub-services.content.destroy');
Route::get('sub-services/content/image-delete',  'Admin\SubServiceContentController@image_delete')->name('sub-services.content.image_delete');
Route::get('sub-services/content/image-delete1',  'Admin\SubServiceContentController@image_delete1')->name('sub-services.content.image_delete1');

// Additional pages content
Route::get('additional_content/{id}/content',  'Admin\AdditionalPageContentController@index')->name('additional-content.content.index');
Route::get('additional_content/{id}/content/create',  'Admin\AdditionalPageContentController@create')->name('additional-content.create');
 Route::post('additional_content/{id}/content/store',  'Admin\AdditionalPageContentController@store')->name('additional-content.store');
Route::get('additional_content/{id}/content/{uuid}/edit',  'Admin\AdditionalPageContentController@edit')->name('additional-content.edit');
Route::post('additional_content/{id}/content/{uuid}/update',  'Admin\AdditionalPageContentController@update')->name('additional-content.update');
Route::post('additional_content/{id}/content/{uuid}/destroy',  'Admin\AdditionalPageContentController@destroy')->name('additional-content.destroy');
Route::get('additional_content/image-delete',  'Admin\AdditionalPageContentController@image_delete')->name('additional_content.image_delete');

//sub service extras
Route::get('content/{uuid}/extra',  'Admin\SubServiceExtraController@index')->name('sub-services.extra.index');
Route::get('content/{uuid}/extra/create',  'Admin\SubServiceExtraController@create')->name('sub-services.extra.create');
Route::post('content/{uuid}/extra/store',  'Admin\SubServiceExtraController@store')->name('sub-services.extra.store');
Route::get('content/{id}/extra/{uuid}/edit',  'Admin\SubServiceExtraController@edit')->name('sub-services.extra.edit');
Route::post('content/{id}/extra/{uuid}/update',  'Admin\SubServiceExtraController@update')->name('sub-services.extra.update');
Route::post('content/{id}/extra/{uuid}/destroy',  'Admin\SubServiceExtraController@destroy')->name('sub-services.extra.destroy');
Route::get('content/extra/image-delete',  'Admin\SubServiceExtraController@image_delete')->name('sub-services.extra.image_delete');

// contact-us
Route::get('contact-us/create',  'Admin\ContactUsController@create')->name('contact-us.create');
Route::post('contact-us/store',  'Admin\ContactUsController@store')->name('contact-us.store');
Route::get('contact-us/image-delete',  'Admin\ContactUsController@image_delete')->name('contact-us.image_delete');
Route::get('contact-us/image-delete1',  'Admin\ContactUsController@image_delete1')->name('contact-us.image_delete1');


// general
Route::get('general/create',  'Admin\GeneralController@create')->name('general.create');
Route::post('general/store',  'Admin\GeneralController@store')->name('general.store');
Route::get('general/image-delete',  'Admin\CaseStudyController@image_delete')->name('general.image_delete');


// sitemap
Route::get('general/sitemap',  'Admin\GeneralController@sitemap')->name('general.sitemap');
Route::post('general/sitemap-generator',  'Admin\GeneralController@sitemap_generator')->name('general.sitemap-generator');


// request rates
Route::get('request/create',  'Admin\RequestRatesController@create')->name('request.settings.create');
Route::post('request/store',  'Admin\RequestRatesController@store')->name('request.settings.store');

// request rate list
Route::get('request/list',  'Admin\RequestRateListController@index')->name('request.list.index');
Route::get('request/list/create',  'Admin\RequestRateListController@create')->name('request.list.create');
Route::post('request/list/store',  'Admin\RequestRateListController@store')->name('request.list.store');
Route::get('request/list/edit/{id}',  'Admin\RequestRateListController@edit')->name('request.list.edit');
Route::post('request/list/update/{id}',  'Admin\RequestRateListController@update')->name('request.list.update');
Route::delete('request/list/destroy/{id}',  'Admin\RequestRateListController@destroy')->name('request.list.destroy');

// feedback
Route::get('feedback/list/create',  'Admin\RequestRateListController@create')->name('request.list.create');

// service care
Route::get('service-care',  'Admin\ServiceCareController@index')->name('service-care.index');
Route::get('service-care/create',  'Admin\ServiceCareController@create')->name('service-care.create');
Route::post('service-care/store',  'Admin\ServiceCareController@store')->name('service-care.store');
Route::get('service-care/edit/{id}',  'Admin\ServiceCareController@edit')->name('service-care.edit');
Route::post('service-care/update/{id}',  'Admin\ServiceCareController@update')->name('service-care.update');
Route::delete('service-care/destroy/{id}',  'Admin\ServiceCareController@destroy')->name('service-care.destroy');

// enquiries
Route::get('enquiries/report',  'Admin\ContactUsReportController@index')->name('enquiries.index');
Route::get('enquries/report/view/{id}',  'Admin\ContactUsReportController@view')->name('enquiries.view');
Route::delete('enquries/report/destroy/{id}',  'Admin\ContactUsReportController@destroy')->name('enquiries.destroy');
Route::get('feedback/report',  'Admin\FeedBackReportController@index')->name('feedbackenquiry.index');
Route::get('request-quote/report',  'Admin\RequestQuoteReportController@index')->name('requestenquiry.index');
Route::get('request-quote/report/view/{id}',  'Admin\RequestQuoteReportController@view')->name('requestenquiry.view');
Route::delete('request-quote/destroy/{id}',  'Admin\RequestQuoteReportController@destroy')->name('requestenquiry.destroy');
Route::get('career/report',  'Admin\CareerReportController@index')->name('careerenquiry.index');
Route::get('career-report/view/{id}',  'Admin\CareerReportController@view')->name('careerenquiry.view');
Route::delete('career-report/destroy/{id}',  'Admin\CareerReportController@destroy')->name('careerenquiry.destroy');



// Seo
Route::get('seo','Admin\SEOController@index')->name('seo.index');
Route::post('seo/create','Admin\SEOController@store')->name('seo.store');
Route::get('seo/{id}/update','Admin\SEOController@update')->name('seo.update');
Route::get('seo/gtm','Admin\SEOController@gtm')->name('seo.gtm');
Route::post('seo/destroy/{id}','Admin\SEOController@destroy')->name('seo.destroy');

//terms & condition
Route::get('terms','Admin\TermsController@index')->name('terms.create');
Route::post('terms/store','Admin\TermsController@store')->name('terms.store');

//privacy & policy
Route::get('privacy','Admin\PolicyController@index')->name('policy.index');
Route::post('privacy/store','Admin\PolicyController@store')->name('policy.store');
Route::get('privacy/image-delete',  'Admin\PolicyController@image_delete')->name('privacy.image_delete');
Route::get('privacy/image-delete-one',  'Admin\PolicyController@image_delete_one')->name('privacy.image_delete_one');

//cookie & policy
Route::get('cookie','Admin\CookieController@index')->name('cookie.index');
Route::post('cookie/store','Admin\CookieController@store')->name('cookie.store');

//password reset
Route::get('settings','Admin\AdminController@show')->name('settings.show');
Route::post('settings/store','Admin\AdminController@store')->name('settings.store');

//update admin
Route::post('setting/update','Admin\ProfileController@update')->name('profile.update');
Route::get('/settings/profile','Admin\ProfileController@index')->name('profile.index');


//Demo industries
Route::get('demo_industries',  'Admin\DemoIndustriesController@index')->name('demo_industries.index');
Route::get('demo_industries/create',  'Admin\DemoIndustriesController@create')->name('demo_industries.create');
Route::post('demo_industries/store',  'Admin\DemoIndustriesController@store')->name('demo_industries.store');
Route::get('demo_industries/edit/{id}',  'Admin\DemoIndustriesController@edit')->name('demo_industries.edit');
Route::post('demo_industries/update/{id}',  'Admin\DemoIndustriesController@update')->name('demo_industries.update');
Route::delete('demo_industries/destroy/{id}',  'Admin\DemoIndustriesController@destroy')->name('demo_industries.destroy');
//Demo industry content
Route::get('demo_industries/{id}/content',  'Admin\DemoIndustriesContentController@index')->name('demo_industries.content.index');
Route::get('demo_industries/{id}/content/create',  'Admin\DemoIndustriesContentController@create')->name('demo_industries.content.create');
Route::post('demo_industries/{id}/content/store',  'Admin\DemoIndustriesContentController@store')->name('demo_industries.content.store');
Route::get('demo_industries/{id}/content/{uuid}/edit',  'Admin\DemoIndustriesContentController@edit')->name('demo_industries.content.edit');
Route::post('demo_industries/{id}/content/{uuid}/update',  'Admin\DemoIndustriesContentController@update')->name('demo_industries.content.update');
Route::post('demo_industries/{id}/content/{uuid}/destroy',  'Admin\DemoIndustriesContentController@destroy')->name('demo_industries.content.destroy');

//Demo industry extra content
Route::get('demo_industries/{id}/extra-content',  'Admin\DemoIndustryExtraContentController@index')->name('demo_industries.content.extra.index');
Route::get('demo_industries/{id}/extra-content/create',  'Admin\DemoIndustryExtraContentController@create')->name('demo_industries.content.extra.create');
Route::post('demo_industries/{id}/extra-content/store',  'Admin\DemoIndustryExtraContentController@store')->name('demo_industries.content.extra.store');
Route::get('demo_industries/{id}/extra-content/{uuid}/edit',  'Admin\DemoIndustryExtraContentController@edit')->name('demo_industries.content.extra.edit');
Route::post('demo_industries/{id}/extra-content/{uuid}/update',  'Admin\DemoIndustryExtraContentController@update')->name('demo_industries.content.extra.update');
Route::post('demo_industries/{id}/extra-content/{uuid}/destroy',  'Admin\DemoIndustryExtraContentController@destroy')->name('demo_industries.content.extra.destroy');

// career opening
Route::get('career-opening','Admin\CareerOpeningController@index')->name('career-opening.index');
Route::get('career-opening/create','Admin\CareerOpeningController@create')->name('career-opening.create');
Route::post('career-opening/store','Admin\CareerOpeningController@store')->name('career-opening.store');
Route::get('career-opening/edit/{id}','Admin\CareerOpeningController@edit')->name('career-opening.edit');
Route::post('career-opening/update/{id}','Admin\CareerOpeningController@update')->name('career-opening.update');
Route::delete('career-opening/destroy/{id}','Admin\CareerOpeningController@destroy')->name('career-opening.destroy');

Route::get('career-opening-settings/create','Admin\CareerOpeningSettingsController@create')->name('career-opening-settings.create');
Route::post('career-opening-settings/store','Admin\CareerOpeningSettingsController@store')->name('career-opening-settings.store');
Route::get('career-opening-settings/image-delete','Admin\CareerOpeningSettingsController@image_delete')->name('career-opening-settings.image_delete');
Route::get('career-opening-settings/image-delete1','Admin\CareerOpeningSettingsController@image_delete1')->name('career-opening-settings.image_delete1');

Route::get('/edit-sitemap', 'Admin\SitemapController@edit')->name('editSitemap');
Route::post('/update-sitemap', 'Admin\SitemapController@update')->name('updateSitemap');
