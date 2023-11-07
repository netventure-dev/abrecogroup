<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schema;

class SchemaApiController extends Controller
{
    public function schema()
    {
        $data['schema'] = Schema::select('id','uuid','title','route_name','description')->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }