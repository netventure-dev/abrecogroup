<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchemaMarkup;

class SchemaApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

    public function schema()
    {
        
        $data['schema'] = SchemaMarkup::select('id','uuid','title','route_name','description')->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
   
}