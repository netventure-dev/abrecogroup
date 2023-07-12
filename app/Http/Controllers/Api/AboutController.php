<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\MissionVision;
use App\Models\AboutUsList;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
 
    public function index()
    {
        $data['about'] = AboutUs::select('cover_title','cover_content','banner_image','content_image','content','link')->first();
        $data['about_list'] = AboutUsList::select('id','title','content','icon','link')->where('status',1)->get();
        $data['mission_vision']=MissionVision::select('id','uuid','title','description','image','mobile_image')->where('status',1)->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
         }
         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
