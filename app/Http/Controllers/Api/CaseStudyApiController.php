<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseStudy;
use App\Models\CaseStudySetting;
use App\Models\Service;
use App\Models\SubService;
use App\Models\InnerService;

class CaseStudyApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
    public function index()
    {
        $data['case_study_settings'] = CaseStudySetting::select('uuid', 'title', 'description', 'image', 'status','seo_title','seo_description','seo_keyword','mobile_image')->first();
        $data['case_studies'] = CaseStudy::select('id','slug as case_study_slug','service_slug as service_id_slug','inner_service_slug as inner_service_id_slug','sub_service_slug as sub_service_id_slug','uuid','title' , 'subtitle','image1','image2', 'content', 'content2', 'button_title','link', 'order','status','seo_title','seo_description','seo_keywords','canonical_tag')
                                ->with(['contents' => function ($query) {
                                    $query->select('id', 'case_id','section', 'uuid','title', 'content','subtitle', 'image1', 'button_title', 'link', 'order','mobile_image', 'status')->where('status', 1);
                                }])
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    public function level_1($uuid)
    {
        $data['case_studies'] = CaseStudy::select('id','slug as case_study_slug','service_slug as service_id_slug','inner_service_slug as inner_service_id_slug','sub_service_slug as sub_service_id_slug','uuid','title' , 'subtitle','image1','image2', 'content', 'content2', 'button_title','link', 'order','status','seo_title','seo_description','seo_keywords','canonical_tag')
                                ->with(['contents' => function ($query) {
                                    $query->select('id', 'case_id', 'section','uuid','title', 'content','subtitle', 'image1', 'button_title', 'link', 'order','mobile_image', 'status')->where('status', 1);
                                }])
                                ->where('service_slug', $uuid)
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    public function level_1_slug($uuid,$case_slug)
    {
        $data['case_studies'] = CaseStudy::select('id','slug as case_study_slug','service_slug as service_id_slug','inner_service_slug as inner_service_id_slug','sub_service_slug as sub_service_id_slug','uuid','title' , 'subtitle','image1','image2', 'content', 'content2', 'button_title','link', 'order','status','seo_title','seo_description','seo_keywords','canonical_tag')
                                ->with(['contents' => function ($query) {
                                    $query->select('id', 'case_id', 'uuid','title', 'section','content','subtitle', 'image1', 'button_title', 'link', 'order','mobile_image', 'status')->where('status', 1);
                                }])
                                ->where('service_slug', $uuid)
                                ->where('slug', $case_slug)
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    public function level_2($uuid,$id)
    {
        $data['case_studies'] = CaseStudy::select('id','slug as case_study_slug','service_slug as service_id_slug','inner_service_slug as inner_service_id_slug','sub_service_slug as sub_service_id_slug','uuid','title' , 'subtitle','image1','image2', 'content', 'content2', 'button_title','link', 'order','status','seo_title','seo_description','seo_keywords','canonical_tag')
                                ->with(['contents' => function ($query) {
                                    $query->select('id', 'case_id', 'uuid','title','section', 'content','subtitle', 'image1', 'button_title', 'link', 'order','mobile_image', 'status')->where('status', 1);
                                }])
                                ->where('service_slug', $uuid)
                                ->where('sub_service_slug', $id)
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function level_2_slug($uuid,$id,$case_slug)
    {
        $data['case_studies'] = CaseStudy::select('id','slug as case_study_slug','service_slug as service_id_slug','inner_service_slug as inner_service_id_slug','sub_service_slug as sub_service_id_slug','uuid','title' , 'subtitle','image1','image2', 'content', 'content2', 'button_title','link', 'order','status','seo_title','seo_description','seo_keywords','canonical_tag')
                                ->with(['contents' => function ($query) {
                                    $query->select('id', 'case_id', 'uuid','title','section', 'content','subtitle', 'image1', 'button_title', 'link', 'order','mobile_image', 'status')->where('status', 1);
                                }])
                                ->where('service_slug', $uuid)
                                ->where('sub_service_slug', $id)
                                ->where('slug',$case_slug)
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    public function level_3($uuid,$id,$idd)
    {
        $data['case_studies'] = CaseStudy::select('id','slug as case_study_slug','service_slug as service_id_slug','inner_service_slug as inner_service_id_slug','sub_service_slug as sub_service_id_slug','uuid','title' , 'subtitle','image1','image2', 'content', 'content2', 'button_title','link', 'order','status','seo_title','seo_description','seo_keywords','canonical_tag')
                                ->with(['contents' => function ($query) {
                                    $query->select('id', 'case_id', 'uuid','title', 'section','content','subtitle', 'image1', 'button_title', 'link', 'order','mobile_image', 'status')->where('status', 1);
                                }])
                                ->where('service_slug', $uuid)
                                ->where('sub_service_slug', $id)
                                ->where('inner_service_slug', $idd)
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    public function level_3_slug($uuid,$id,$idd,$case_slug)
    {
        $data['case_studies'] = CaseStudy::select('id','slug as case_study_slug','service_slug as service_id_slug','inner_service_slug as inner_service_id_slug','sub_service_slug as sub_service_id_slug','uuid','title' , 'subtitle','image1','image2', 'content', 'content2', 'button_title','link', 'order','status','seo_title','seo_description','seo_keywords','canonical_tag')
                                ->with(['contents' => function ($query) {
                                    $query->select('id', 'case_id', 'uuid','title','section', 'content','subtitle', 'image1', 'button_title', 'link', 'order','mobile_image', 'status')->where('status', 1);
                                }])
                                ->where('service_slug', $uuid)
                                ->where('sub_service_slug', $id)
                                ->where('inner_service_slug', $idd)
                                ->where('slug',$case_slug)
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
