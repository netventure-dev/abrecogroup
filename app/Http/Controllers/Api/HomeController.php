<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Bloglist;
use App\Models\General;
use App\Models\HomeSlider;
use App\Models\Service;
use App\Models\Section;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public $successStatus = 200;
    public $failedStatus = 400;

    public function index()
    {
        $data['home_sliders'] = HomeSlider::where('status', 1)->select('title', 'sub_title','mobile_slider', 'description', 'image', 'button_title', 'link')->get();
        // 
        $data['services'] = Service::select('id', 'uuid', 'name', 'cover_image', 'logo', 'slug', 'cover_description', 'title', 'description', 'status')
            ->with(['faqs' => function ($query) {
                $query->select('id', 'service_id', 'uuid', 'title', 'description', 'order')->where('status', 1);
            }, 'contents' => function ($query) {
                $query->select('id', 'service_id', 'uuid', 'title', 'description', 'order', 'image')->where('status', 1);
            }, 'subservices' => function ($query) {
                $query->select('id', 'service_id', 'service as service_name', 'uuid', 'name', 'cover_image', 'logo', 'slug', 'cover_description', 'title', 'description')->where('status', 1);
            }, 'subservices.innerservices' => function ($query) {
                $query->select('id', 'sub_service_id', 'subservice as subservice_name', 'uuid', 'name', 'cover_image', 'logo', 'slug', 'cover_description', 'title', 'description')->where('status', 1);
            },])
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        // 
        // $data['blog']=Blog::select('uuid','title','description','image')->where('status',1)->get();     
        $data['blogLists'] = Bloglist::select('uuid', 'title', 'description', 'image', 'slug')->where('status', 1)->get();
        $data['testimonials'] = Testimonial::select('uuid', 'title', 'position', 'description', 'image')->where('status', 1)->get();
        $data['sections'] = Section::with(['contents' => function ($query) {
            $query->select('uuid', 'section_id', 'slug', 'title', 'subtitle', 'icon', 'icon_content', 'button_title', 'link', 'order')->where('status', 1);
        },])
            ->select('uuid', 'slug', 'title', 'subtitle', 'image1', 'image2', 'content', 'button_title', 'link', 'order')
            ->where('status', 1)
            ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function general()
    {
        $data['general'] = General::select('address', 'mobile', 'logo', 'facebook', 'instagram', 'twitter', 'linkdln', 'youtube')->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
