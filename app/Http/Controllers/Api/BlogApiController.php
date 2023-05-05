<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bloglist;
use App\Models\Blog;
use Illuminate\Http\Request;


class BlogApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

   public function index()
   {
        $data['blogLists'] = Bloglist::select('uuid', 'title', 'description', 'image', 'slug')->where('status', 1)->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   }
}