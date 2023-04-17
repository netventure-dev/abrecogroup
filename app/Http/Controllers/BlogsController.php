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
        $blogs=Blog::get();
        $blogLists=Bloglist::where('status',1)->get();
        return view('blogs.index',compact('blogs', 'blogLists'));
    }

    public function show()
    {
        // $blog=Blog::where('slug',$slug)->first();
        // return view('blogs.index',compact('blog'));
        return view('blogs.show');
    }

}
