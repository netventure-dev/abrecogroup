<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Terms;
use Illuminate\Http\Request;

class PolicyPageApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
    public function terms()
   {
        $data['pages'] = Terms::select('uuid', 'title','content','image')->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   }
}
