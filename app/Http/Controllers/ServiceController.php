<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceContent;
use App\Models\ServiceContentList;
use App\Models\ServiceFaq;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index($slug)
    {
        $service = Service::where('slug',$slug)->where('status',1)->first();
        if($service){
        $content = ServiceContent::where('service_id',$service->uuid)->get();
        $faqs = ServiceFaq::where('service_id',$service->uuid)->get();
       
            return view('service',with(['service' => $service,'content' => $content,'faqs' => $faqs]));
        }else{
            abort(404);
        }
    }
}
