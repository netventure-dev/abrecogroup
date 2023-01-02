<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Models\WhyChooseUsSettings;;
use App\Models\WhyChooseUs;
use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
        $home_sliders=HomeSlider::where('status',1)->get();
        $technical_service=WhyChooseUsSettings::first();
        $technical_services_list=WhyChooseUs::where('status',1)->get();
        return view('home',compact('home_sliders','technical_service','technical_services_list'));
    }

}
