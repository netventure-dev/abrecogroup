<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\IndustryContent;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

    public function index()
    {
        $data['industries'] = Industry::with(['contents' => function ($query) {
                $query->where('status', 1)
                            ->select('id', 'uuid', 'industries_id', 'title','subtitle', 'description', 'order', 'image', 'button_title', 'button_link')
                            ->orderBy('order', 'ASC');
                    },'contents.extra_contents'])
                    ->where('status', 1)->select('id', 'uuid','slug', 'name','custom_url','subtitle','icon','image','content','button_title','link')
                    ->orderBy('created_at', 'desc')
                    ->get();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function details($uuid)
    {
        $data['industry'] = Industry::where('slug', $uuid)->where('status', 1)
            ->select('id', 'uuid', 'custom_url','name','slug')
            ->with(['contents' => function ($query) {
                $query->where('status', 1)
                    ->select('id', 'uuid', 'industries_id', 'title','subtitle', 'description', 'order', 'image','mobile_image', 'button_title', 'button_link')
                    ->orderBy('order', 'ASC');
            },'contents.extra_contents'])->first();
        // $data['industry']['industry_content'] =  $data['industry']->contents->where('status',1);

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
