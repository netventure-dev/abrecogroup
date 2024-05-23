<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LifeAbreco;
use App\Models\LifeAtAbrecoBanner;
use App\Models\LifeAtAbrecoContent;
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
        // Set null values for 'icon' field in each item in 'about_list' data
        // foreach ($data['about_list'] as $aboutList) {
        //     $aboutList->icon = empty($aboutList->icon) ? null : $aboutList->icon;
        // }
        // $data['mission_vision'] = MissionVision::select('id', 'uuid', 'title', 'description', 'image', 'mobile_image', 'status', 'canonical_tag', 'schema')->get()

        //     ->map(function ($item) {
        //         //  dd($item);
        //         if ($item->status == 0) {
        //             return [
        //                 'id' => null,
        //                 'title' => null,
        //                 'description' => null,
        //                 'image' => null,
        //                 'mobile_image' => null,

        //             ];
        //         } else {
        //             return $item;
        //         }
        //     });

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
  

   
}
