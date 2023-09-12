<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SubService;
use App\Models\InnerService;
use Illuminate\Http\Request;

class ServiceApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
 
    public function index()
    {
        $data['services'] = Service::select('id', 'uuid', 'name','custom_url','cover_image','logo','slug','cover_description','title','description','status')
                                ->with(['faqs'=> function($query) {
                                    $query->select('id','service_id', 'uuid', 'title','description','order')->where('status',1);
                                }, 'contents' => function($query) {
                                    $query->select('id','service_id', 'uuid', 'title','sub_title','description','order','image')->where('status',1);
                                }, 'casestudy' => function($query) {
                                    $query->select('id','service_id','service_slug as service_id_slug','sub_service_slug as sub_service_id_slug','inner_service_slug as inner_service_id_slug', 'uuid', 'title','subtitle','image1','content','image2')->where('status',1);
                                },'subservices' => function($query) {
                                    $query->select('id','service_id','service as service_name','custom_url', 'uuid', 'name','cover_image','logo','slug','cover_description','title','description')->where('status',1);
                                },'subservices.innerservices'=> function($query) {
                                    $query->select('id','service_id','sub_service_id','subservice as subservice_name','custom_url','service_name','service_slug', 'uuid', 'name','cover_image','logo','slug','cover_description','title','description')->where('status',1);
                                },'contents.extra_contents'])
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function details($uuid)
    {
        $data['services'] = Service::select('id', 'uuid', 'name','custom_url','cover_image','logo','slug','cover_description','title','description','status')
                                ->with(['faqs'=> function($query) {
                                    $query->select('id','service_id', 'uuid', 'title','description','order')->where('status',1);
                                }, 'contents' => function($query) {
                                    $query->select('id','service_id', 'uuid', 'title','sub_title','description','order','image','mobile_image')->where('status',1);
                                }, 'casestudy' => function($query) {
                                    $query->select('id','service_id','service_slug as service_id_slug','sub_service_slug as sub_service_id_slug','inner_service_slug as inner_service_id_slug', 'uuid', 'title','subtitle','image1','content','image2')->where('status',1);
                                },'subservices' => function($query) {
                                    $query->select('id','service_id','service as service_name','service_slug', 'uuid', 'name','cover_image','logo','slug','cover_description','title','description')->where('status',1);
                                },'subservices.innerservices'=> function($query) {
                                    $query->select('id','service_id','sub_service_id', 'service_name','service_slug','subservice as subservice_name', 'sub_service_slug','uuid', 'name','cover_image','logo','slug','cover_description','title','description')->where('status',1);
                                },'contents.extra_contents'])
                                ->where('slug', $uuid)
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    public function sub_services($uuid,$sub_id)
    {
        $data['sub_services'] = SubService::select('id','service_id','service as service_name','service_slug','uuid','custom_url', 'name','cover_image','logo','slug','cover_description','title','description','status')
                                ->with(['innerservices'=> function($query) {
                                    $query->select('id','service_id','sub_service_id','service_name','service_slug','subservice as subservice_name', 'sub_service_slug','uuid', 'name','cover_image','logo','slug','cover_description','title','description')->where('status',1);
                                },'contents' => function($query) {
                                    $query->select('id','sub_service_id', 'uuid', 'title','sub_title','description','order','image','mobile_image')->where('status',1);
                                }, 'casestudy' => function($query) {
                                    $query->select('id','service_slug as service_id_slug','sub_service_id','sub_service_slug as sub_service_id_slug', 'inner_service_slug as inner_service_id_slug','uuid', 'title','subtitle','image1','content','image2')->where('status',1);
                                },'contents.extra_contents'])
                                ->where('slug', $sub_id)
                                ->where('service_slug', $uuid)
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    public function inner_services($id,$uuid,$sub_id)
    {
        $data['inner_services'] = InnerService::select('id','service_id','sub_service_id','service_name','service_slug','custom_url','subservice as subservice_name', 'sub_service_slug','uuid', 'name','cover_image','logo','slug','cover_description','title','description','status')
        ->with(['contents' => function($query){
        $query->select('id', 'inner_service_id','uuid', 'title','sub_title', 'description', 'order','image')->where('status',1);
                                }, 'casestudy' => function($query) {
                                    $query->select('id','service_slug as service_id_slug','inner_service_id','sub_service_slug as sub_service_id_slug', 'inner_service_slug as inner_service_id_slug','uuid', 'title','subtitle','image1','content','image2')->where('status',1);
                                },'contents.extra_contents'])
                                ->where('slug', $sub_id)
                                ->where('sub_service_slug', $uuid)
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
