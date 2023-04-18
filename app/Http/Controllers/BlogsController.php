<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Seo;
use App\Models\Bloglist;

class BlogsController extends Controller
{
    use SEOToolsTrait;
    public function index()
    {
        $blogLists=Bloglist::where('status',1)->get();
        return view('blogs.index',compact('blogLists'));
    }

    public function show(Request $request,$slug)
    {
        $blog=Bloglist::where('slug',$slug)->first();
        $relatedPosts=Bloglist::where('slug', '<>', $slug)->get();
        return view('blogs.show',compact('blog','relatedPosts'));
    }

}
