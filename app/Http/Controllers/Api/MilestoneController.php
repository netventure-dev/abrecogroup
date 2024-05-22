<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MilestoneSetting;
class MilestoneController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;


    
    public function index()
    {
        $data['milestone'] = MilestoneSetting::where('status', 1)
             ->select('id', 'uuid','title', 'color')
             ->with(['milestonelist' => function ($query) {
               $query->select('id', 'uuid', 'milestone_id', 'title', 'description', 'logo')
              ->orderBy('created_at', 'ASC');
        }])->first();

        // $data['industry']['industry_content'] =  $data['industry']->contents->where('status',1);

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
