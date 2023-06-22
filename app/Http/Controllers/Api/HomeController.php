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
        $data['all_sections'] = Section::with(['contents' => function ($query) {
                                $query->select('uuid', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order')->where('status', 1);
                            }])
                            ->select('uuid', 'title','slug', 'subtitle', 'image1', 'image2', 'content','content2', 'button_title', 'link', 'order')
                            ->whereIn('order',[1,2,4,9])
                            ->where('status', 1)
                            ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function general()
    {
        $data['general'] = General::select('address', 'mobile','email', 'logo','light_logo','site_title', 'facebook', 'instagram', 'twitter', 'linkdln', 'youtube')->first();
        $data['all_services'] = Service::select('id', 'uuid', 'name')
                            ->with(['subservices' => function ($query) {
                                $query->select('id', 'service_id', 'service as service_name', 'uuid', 'name')->where('status', 1);
                            }, 'subservices.innerservices' => function ($query) {
                                $query->select('id', 'sub_service_id', 'subservice as subservice_name', 'uuid', 'name')->where('status', 1);
                            },])
                            ->where('status', 1)
                            ->orderBy('created_at', 'desc')
                            ->get(); 
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }   
    public function section_3()
    {
       // section 1
       $data['section_3_driven'] = Section::with(['contents' => function ($query) {
                                $query->select('uuid', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order')->where('status', 1);
                            }])
                            ->select('uuid', 'title','slug', 'subtitle', 'image1', 'image2', 'content','content2','button_title', 'link', 'order')
                            ->where('order',3)
                            ->where('status', 1)
                            ->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }   
    public function section_5()
    {
       // section 1
       $data['section_5_Services'] = Section::with(['contents' => function ($query) {
                                $query->select('uuid', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order')->where('status', 1);
                            }])
                            ->select('uuid', 'title','slug', 'subtitle', 'image1', 'image2', 'content', 'button_title', 'link', 'order')
                            ->where('order',5)
                            ->where('status', 1)
                            ->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }   
    public function section_6()
    {
       // section 1
       $data['section_6_case'] = Section::with(['contents' => function ($query) {
                                $query->select('uuid', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order')->where('status', 1);
                            }])
                            ->select('uuid', 'title','slug', 'subtitle', 'image1', 'image2', 'content', 'button_title', 'link', 'order')
                            ->where('order',6)
                            ->where('status', 1)
                            ->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }   
    public function section_7()
    {
       // section 1
       $data['section_7_industries'] = Section::with(['contents' => function ($query) {
                                $query->select('uuid', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order')->where('status', 1);
                            }])
                            ->select('uuid', 'title','slug', 'subtitle', 'image1', 'image2', 'content', 'button_title', 'link', 'order')
                            ->where('order',7)
                            ->where('status', 1)
                            ->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }  
    public function section_8()
    {
       // section 1
       $data['section_8_why'] = Section::with(['contents' => function ($query) {
                                $query->select('uuid', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order')->where('status', 1);
                            }])
                            ->select('uuid', 'title','slug', 'subtitle', 'image1', 'image2', 'content', 'button_title', 'link', 'order')
                            ->where('order',8)
                            ->where('status', 1)
                            ->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }    
}
