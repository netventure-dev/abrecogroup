<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AbrecoWorkingPrinclple;
use App\Models\AbrecoWorkingPrinclpleList;
use App\Models\LifeAbreco;
use App\Models\LifeAtAbrecoBanner;
use App\Models\LifeAtAbrecoContent;
use App\Models\LifeAtAbrecoValue;
use App\Models\LifeAtAbrecoValueList;
use App\Models\Logo;
use Illuminate\Http\Request;

class LifeAtAbrecoApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

    public function index()
    {
        $data['banner'] = LifeAtAbrecoBanner::select('uuid', 'title', 'sub_title', 'image')->first();
        // Set null values for specified fields in the 'about' data
        // if (!empty($data['about'])) {
        //     $data['about']->banner_image = empty($data['about']->banner_image) ? null : $data['about']->banner_image;
        //     $data['about']->content_image = empty($data['about']->content_image) ? null : $data['about']->content_image;
        // }
        $data['content'] = LifeAtAbrecoContent::select('uuid', 'title', 'content')->first();
        $data['value-settings'] = LifeAtAbrecoValue::select('uuid', 'title', 'image')->first();
        $data['value-list'] = LifeAtAbrecoValueList::select('uuid', 'title', 'content')->get();

        $data['work-settings'] = AbrecoWorkingPrinclple::select('uuid', 'title','content', 'image')->first();
        $data['work-list'] = AbrecoWorkingPrinclpleList::select('uuid', 'title','content')->where('status',1)->get();




      

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
  

   
}
