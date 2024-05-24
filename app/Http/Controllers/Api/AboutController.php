<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\MissionVision;
use App\Models\AboutUsList;
use App\Models\ImpactSetting;
use App\Models\ImpactList;
use App\Models\Counter;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

//     public function index()
//     {
//         $data['about'] = AboutUs::select('cover_title', 'cover_content', 'banner_image', 'content_image', 'content', 'link', 'seo_title', 'seo_description', 'seo_keywords', 'canonical_tag','schema')->first();
//         // Set null values for specified fields in the 'about' data
//       if (!empty($data['about'])) {
//     $data['about']->banner_image = empty($data['about']->banner_image) ? null : $data['about']->banner_image;
//     $data['about']->content_image = empty($data['about']->content_image) ? null : $data['about']->content_image;
// }
//         $data['about_list'] = AboutUsList::select('id', 'title', 'content', 'icon', 'link', 'canonical_tag','schema')->where('status', 1)->get();
//         // Set null values for 'icon' field in each item in 'about_list' data
//         foreach ($data['about_list'] as $aboutList) {
//     $aboutList->icon = empty($aboutList->icon) ? null : $aboutList->icon;
//         }
//         $data['mission_vision'] = MissionVision::select('id', 'uuid', 'title', 'description', 'image', 'mobile_image', 'status', 'canonical_tag','schema')->get()

//             ->map(function ($item) {
//                 //  dd($item);
//                 if ($item->status == 0) {
//                     return [
//                         'id' => null,
//                         'title' => null,
//                         'description' => null,
//                         'image' => null,
//                         'mobile_image' => null,

//                     ];
//                 } else {
//                     return $item;
//                 }
//             });

//         if (!empty($data)) {
//             return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
//         }
//         return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
//     }
public function index()
{
    $data['about'] = AboutUs::select('title', 'sub_title', 'content', 'sub_content', 'image')->get();
    $data['mission'] = MissionVision::select('mission_title', 'mission_content', 'mission_image', 'vision_title', 'vision_content','vision_image','values_title','values_content','values_image')->get();
    $data['impact_setting'] = ImpactSetting::select('title', 'content')->get();
    $data['impact_list'] = ImpactList::select('title', 'content','image')->where('status',1)->get();
    $data['counter'] = Counter::select('title', 'counter') ->where('status', 1)->orderBy('order', 'asc')->get();

    if (!empty($data)) {
        return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
    }
    return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
}
}
