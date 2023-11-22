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
        $data['blog'] = Blog::select('uuid', 'title', 'canonical_tag', 'description', 'image', 'status', 'seo_title', 'seo_description', 'seo_keyword')->first();
        // Check if 'image' field is empty and set it to null
        if (!empty($data['blog']) && empty($data['blog']->image)) {
            $data['blog']->image = null;
        }
        $data['blogLists'] = Bloglist::select('uuid', 'title','author','blog_date', 'canonical_tag', 'description', 'image', 'slug', 'seo_title', 'seo_description', 'seo_keywords')->where('status', 1)->take(3)->get();
        // Check if 'image' field is empty and set it to null for each item in blogLists
        foreach ($data['blogLists'] as $blogList) {
            if (empty($blogList->image)) {
                $blogList->image = null;
            }
        }
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function details($uuid)
    {
        $data['blogLists'] = Bloglist::select('uuid', 'title','author','blog_date', 'canonical_tag', 'description', 'image', 'slug', 'seo_title', 'seo_description', 'seo_keywords')
            ->where('slug', $uuid)
            ->where('status', 1)
            ->first();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
