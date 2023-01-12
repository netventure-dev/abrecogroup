<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceContent;
use App\Models\ServiceContentList;
use App\Models\ServiceFaq;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Seo;


class ServiceController extends Controller
{
    use SEOToolsTrait;

    public function index($slug)
    {
        $service = Service::where('slug',$slug)->where('status',1)->first();
        if($service){
        $content = ServiceContent::where('service_id',$service->uuid)->get();
        $faqs = ServiceFaq::where('service_id',$service->uuid)->get();
        $seo = Seo::where('route_name',$slug)->first();

        $this->seo()->setTitle(@$seo->seo_title);
        $this->seo()->setDescription(@$seo->seo_description);
        SEOMeta::setKeywords([@$seo->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$seo->seo_title);
        $this->seo()->opengraph()->setDescription(@$seo->seo_description);
        $this->seo()->twitter()->setTitle(@$seo->seo_title);
        $this->seo()->twitter()->setDescription(@$seo->seo_description);
       
            return view('service',with(['service' => $service,'content' => $content,'faqs' => $faqs]));
        }else{
            abort(404);
        }
    }
}
