<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseStudy;
use App\Models\Service;
use App\Models\SubService;
use App\Models\InnerService;

class CaseStudyApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
    public function index()
    {
        $data['case_studies'] = CaseStudy::select('id','service_id','slug','inner_service_id','sub_service_id','uuid','title' , 'subtitle','image1','image2', 'content', 'content2', 'button_title','link', 'order','status')
                                ->with(['contents' => function ($query) {
                                    $query->select('id', 'case_id', 'uuid','title', 'content','subtitle', 'image1', 'button_title', 'link', 'order', 'status')->where('status', 1);
                                }])
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
