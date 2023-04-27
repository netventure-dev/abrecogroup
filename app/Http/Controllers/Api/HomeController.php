<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Bloglist;
use App\Models\General;
use App\Models\HomeSlider;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{

   public $successStatus = 200;
   public $failedStatus = 400;

   public function index()
   {
      $data['home_sliders'] = HomeSlider::where('status', 1)->select('title', 'description', 'image', 'link')->get();
      // 
      $data['services'] = Service::select('id', 'uuid', 'name','cover_image','logo','slug','cover_description','title','description','status')
                                ->with(['faqs'=> function($query) {
                                    $query->select('id','service_id', 'uuid', 'title','description','order')->where('status',1);
                                }, 'contents' => function($query) {
                                    $query->select('id','service_id', 'uuid', 'title','description','order','image')->where('status',1);
                                },'subservices' => function($query) {
                                    $query->select('id','service_id', 'uuid', 'name','cover_image','logo','slug','cover_description','title','description')->where('status',1);
                                },'subservices.innerservices'=> function($query) {
                                    $query->select('id','sub_service_id', 'uuid', 'name','cover_image','logo','slug','cover_description','title','description')->where('status',1);
                                },])
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
      // 
      // $data['blog']=Blog::select('uuid','title','description','image')->where('status',1)->get();
      $data['general'] = General::select('address', 'mobile', 'logo', 'facebook', 'instagram', 'twitter', 'linkdln', 'youtube')->first();
      $data['blogLists'] = Bloglist::select('uuid', 'title', 'description', 'image', 'slug')->where('status', 1)->get();
      $data['testimonials'] = Testimonial::select('uuid', 'title', 'description', 'image')->where('status', 1)->get();
      if (!empty($data)) {
         return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
      }
      return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   }
}
