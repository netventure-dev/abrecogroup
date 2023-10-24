<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Blog;

class BlogSettingController extends Controller
{
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $blog= Blog::first();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Blog', route('admin.blog-settings.create')],
            ['Create', route('admin.blog-settings.create')],
        ];
        return view('admin.app.blog.create', compact('breadcrumbs','blog'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required|unique:blogs,title',
            'description' => 'required',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
        ]);
        $blogs = Blog::firstOrCreate();      
        $blogs->uuid = (string) Str::uuid();
        $blogs->title = $validated['title'];
        $blogs->description = $validated['description'];
        $blogs->seo_title = $validated['seo_title'];
        $blogs->seo_keyword = $validated['seo_keyword'];
        $blogs->seo_description = $validated['seo_description'];
        
        $blogs->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/blogs/image', $validated['image']->getClientOriginalName(), 'public');
            $blogs->image = $path;
        }
        $res = $blogs->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
}
