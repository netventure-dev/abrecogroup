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
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}