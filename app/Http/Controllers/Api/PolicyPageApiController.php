<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cookie;
use App\Models\Privacy;
use App\Models\Terms;
use Illuminate\Http\Request;

class PolicyPageApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
    public function terms()
   {
        $data['terms'] = Terms::select('uuid', 'title','content','image')->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   }

   public function policy()
   {
    $data['privacy'] = Privacy::select('uuid', 'title','content','image')->first();
        // Set image to null if it's empty
        if (!empty($data['privacy']) && empty($data['privacy']->image)) {
            $data['privacy']->image = null;
        }
    if (!empty($data)) {
        return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
    }
    return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   }

   public function cookie()
   {

    $data['cookie'] = Cookie::select('uuid', 'title','content','image')->first();
    if (!empty($data)) {
        return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
    }
    return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   }
}
