<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\IndustryContent;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 500;

    public function index()
    {
        $data['industries'] = Industry::where('status', 1)->select('id', 'uuid', 'name')->orderBy('created_at', 'desc')->get();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->successStatus);
    }

    public function details($uuid)
    {
        $data['industry'] = Industry::where('uuid', $uuid)->where('status', 1)
            ->select('id', 'uuid', 'name')
            ->with(['content' => function ($query) {
                $query->where('status', 1)
                    ->select('id', 'uuid', 'industries_id', 'title', 'description', 'order', 'image', 'button_title', 'button_link')
                    ->orderBy('order', 'ASC');
            }])->first();
        // $data['industry']['industry_content'] =  $data['industry']->contents->where('status',1);

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->successStatus);
    }
}
