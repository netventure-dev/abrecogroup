<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdditionalPage;
use Illuminate\Http\Request;

class AdditionalPageApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
    public function index()
   {
        $data['pages'] = AdditionalPage::select('uuid', 'title', 'slug', 'subtitle', 'image1','alt_text','image2','logo_alt_text','background_image','content','content2','button_title','link')->where('status', 1)->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   }
}
