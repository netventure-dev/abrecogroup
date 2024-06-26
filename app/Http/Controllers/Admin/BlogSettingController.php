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
            'title' => 'required',
            'description' => 'required',
            'canonical_tag' => 'nullable',
            'schema' => 'nullable',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
            'image' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_image'=>'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
        ]);
        $blogs = Blog::firstOrCreate();      
        $blogs->uuid = (string) Str::uuid();
        $blogs->title = $validated['title'];
        $blogs->canonical_tag = $validated['canonical_tag'];
        $blogs->schema = $validated['schema'];
        $blogs->description = $validated['description'];
        $blogs->seo_title = $validated['seo_title'];
        $blogs->seo_keyword = $validated['seo_keyword'];
        $blogs->seo_description = $validated['seo_description'];
        
        $blogs->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/blogs/image', $validated['image']->getClientOriginalName(), 'public');
            $blogs->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/blogs/mobile_image', $validated['mobile_image']->getClientOriginalName(), 'public');
            $blogs->mobile_image = $path;
        }
        $res = $blogs->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

    public function image_delete(Request $request)
    {

        $data = Blog::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }
    public function image_delete_one(Request $request)
    {

        $data = Blog::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->mobile_image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }
}
