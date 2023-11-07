<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchemaMarkup;
use Illuminate\Http\Request;

class SchemaApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
    public function schema($slug)
    {
        $data['schema'] = SchemaMarkup::select('id', 'uuid', 'title', 'route_name', 'description', 'status')->where('route_name',$slug)->first();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
