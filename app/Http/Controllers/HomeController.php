<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Models\WhyChooseUsSettings;
use App\Models\WhyChooseUs;
use App\Models\OurProjects;
use App\Models\General;
use App\Models\Blog;
use App\Models\BlogList;
use App\Models\HomeSlider;
use App\Models\Testimonial;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
        $home_sliders=HomeSlider::where('status',1)->get();
        $technical_service=WhyChooseUsSettings::first();
        $our_projects=OurProjects::where('status',1)->get();
        $technical_services_list=WhyChooseUs::where('status',1)->get();
        $services=Service::with('faqs','contents')->where('status',1)->get();
        $blog=Blog::first();
        $general=General::first();
        $blogLists=BlogList::where('status',1)->get();
        $testimonials=Testimonial::where('status',1)->get();
        return view('home',compact('general','home_sliders','technical_service','blog','blogLists','technical_services_list','services','our_projects','testimonials'));
    }

}
