<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LifeAbreco;
use App\Models\Logo;
use Illuminate\Http\Request;

class LifeAtAbrecoApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
    public function life ()
    {
        $data['life'] = LifeAbreco::select('id', 'title', 'url', 'image')->get();
       
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function logo ()
    {
        $data['logo'] = Logo::select('id', 'order','image')->get();
       
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
