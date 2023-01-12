<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Models\WhyChooseUsSettings;
use App\Models\WhyChooseUs;
use App\Models\OurProjects;
use App\Models\General;
use App\Models\Blog;
use App\Models\Bloglist;
use App\Models\HomeSlider;
use App\Models\Seo;
use App\Models\Testimonial;
use App\Models\Service;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class HomeController extends Controller
{
    use SEOToolsTrait;

    public function index(){
        
        $home_sliders=HomeSlider::where('status',1)->get();
        $technical_service=WhyChooseUsSettings::first();
        $our_projects=OurProjects::where('status',1)->get();
        $technical_services_list=WhyChooseUs::where('status',1)->get();
        $services=Service::with('faqs','contents')->where('status',1)->get();
        $blog=Blog::first();
        $general=General::first();
        $blogLists=Bloglist::where('status',1)->get();
        $testimonials=Testimonial::where('status',1)->get();
        $seo = Seo::where('route_name','home')->first();

        $this->seo()->setTitle(@$seo->seo_title);
        $this->seo()->setDescription(@$seo->seo_description);
        SEOMeta::setKeywords([@$seo->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$seo->seo_title);
        $this->seo()->opengraph()->setDescription(@$seo->seo_description);
        $this->seo()->twitter()->setTitle(@$seo->seo_title);
        $this->seo()->twitter()->setDescription(@$seo->seo_description);
        // // dd($services);
        return view('home',compact('general','home_sliders','technical_service','blog','blogLists','technical_services_list','services','our_projects','testimonials'));
    }

}
