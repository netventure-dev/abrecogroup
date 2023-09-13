<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seo;

class SeoApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

    public function index($slug)
    {
        $data['seo'] = Seo::select('id', 'uuid', 'route_name', 'seo_title', 'seo_description', 'seo_keywords')
                             ->where('route_name',$slug)
                             ->get();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
