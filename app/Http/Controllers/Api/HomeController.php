<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Bloglist;
use App\Models\BusinessList;
use App\Models\BusinessSetting;
use App\Models\Contact;
use App\Models\DreamDestination;
use App\Models\General;
use App\Models\HomeSlider;
use App\Models\InclusiveSupport;
use App\Models\LifeAbreco;
use App\Models\Logo;
use App\Models\MilestoneSetting;
use App\Models\MultiFacted;
use App\Models\News;
use App\Models\OfficeLocation;
use App\Models\Service;
use App\Models\TestimonialSetting;
use App\Models\Section;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{

    public $successStatus = 200;
    public $failedStatus = 400;

    public function index()
    {
        $data['home_sliders'] = HomeSlider::where('status', 1)->select('title', 'sub_title', 'mobile_slider', 'description', 'image', 'button_title', 'link')->get();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function general()
    {
        $data['home_sliders'] = HomeSlider::where('status', 1)->select('title', 'sub_title', 'mobile_slider', 'description', 'image', 'button_title', 'link', 'canonical_tag', 'schema')->get();

        $data['general'] = General::select('address', 'mobile', 'email', 'logo', 'light_logo', 'site_title', 'facebook', 'instagram', 'twitter', 'linkdln', 'youtube', 'favicon', 'yt_image', 'fb_image', 'ld_image', 'twt_image', 'ig_image', 'seo_title', 'seo_description', 'seo_keywords')->first();
        $data['all_services'] = Service::select('id', 'uuid', 'name')
            ->with(['subservices' => function ($query) {
                $query->select('id', 'service_id', 'service as service_name', 'uuid', 'name', 'status')->where('status', 1);
            }, 'subservices.innerserv   ices' => function ($query) {
                $query->select('id', 'sub_service_id', 'subservice as subservice_name', 'uuid', 'name', 'status')->where('status', 1);
            },])
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }


    // public function section_6()
    // {
    //     // section 1
    //     $data['section_6_case'] = Section::with(['contents' => function ($query) {
    //         $query->select('uuid', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order', 'status')->where('status', 1);
    //     }])
    //         ->select('uuid', 'title', 'slug', 'subtitle', 'image1', 'image2', 'content', 'button_title', 'link', 'order', 'status')
    //         ->where('order', 6)
    //         ->where('status', 1)
    //         ->first();
    //     if (!empty($data)) {
    //         return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
    //     }
    //     return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    // }
    // public function section_7()
    // {
    //     // section 1
    //     $data['section_7_industries'] = Section::with(['contents' => function ($query) {
    //         $query->select('uuid', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order', 'status')->where('status', 1);
    //     }])
    //         ->select('uuid', 'title', 'slug', 'subtitle', 'image1', 'image2', 'content', 'button_title', 'link', 'order', 'status')
    //         ->where('order', 7)
    //         ->where('status', 1)
    //         ->first();
    //     if (!empty($data)) {
    //         return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
    //     }
    //     return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    // }
    // public function section_8()
    // {
    //     // section 1
    //     $data['section_8_why'] = Section::with(['contents' => function ($query) {
    //         $query->select('uuid', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order', 'status')->where('status', 1);
    //     }])
    //         ->select('uuid', 'title', 'slug', 'subtitle', 'image1', 'image2', 'content', 'button_title', 'link', 'order', 'status')
    //         ->where('order', 8)
    //         ->where('status', 1)
    //         ->first();
    //     if (!empty($data)) {
    //         return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
    //     }
    //     return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    // }

    public function business_settings()
    {
        // section 1
        $data['business_settings'] = BusinessSetting::select('uuid', 'title', 'content')
            ->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function business_list()
    {
        // section 1
        $data['business_list'] = BusinessList::select('id', 'title', 'url', 'image')
            ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }


    public function milestone()
    {
        $data['milestone'] = MilestoneSetting::where('status', 1)
            ->select('id', 'uuid', 'title', 'color')
            ->with(['milestonelist' => function ($query) {
                $query->select('id', 'uuid', 'milestone_id', 'title', 'description', 'logo')
                    ->orderBy('created_at', 'ASC');
            }])->first();

        // $data['industry']['industry_content'] =  $data['industry']->contents->where('status',1);

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }



    public function testimonial()
    {
        $data['testimonials'] = Testimonial::select('uuid', 'title', 'description', 'image')->where('status', 1)->get();
        // foreach ($data['testimonials'] as $contact) {
        //     if (empty($contact->image)) {
        //         $contact->image = null;
        //     }
        // }
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function news()
    {
        $data['news'] = News::select('uuid', 'title', 'description', 'image', 'slug')->where('status', 1)->get();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function life()
    {
        $data['life'] = LifeAbreco::select('id', 'title', 'url', 'image')->get();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function logo()
    {
        $data['logo'] = Logo::select('id', 'order', 'image')->get();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    public function Location()
    {
        $data['Location'] = OfficeLocation::select('uuid', 'title', 'sub_title', 'location_name', 'location_url', 'image', 'status')->get();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }


    public function multifaceted()
    {
        $data['multifaceted'] = MultiFacted::select('uuid', 'title', 'sub_title')->first();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function inclusive()
    {
        $data['inclusive'] = InclusiveSupport::select('uuid', 'title', 'sub_title', 'image')->first();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function dream()
    {
        $data['dream'] = DreamDestination::select('uuid', 'title', 'quote', 'image','content','author','position')->first();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
