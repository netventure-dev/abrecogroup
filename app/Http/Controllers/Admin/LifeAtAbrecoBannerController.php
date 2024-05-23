<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LifeAtAbrecoBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class LifeAtAbrecoBannerController extends Controller
{
    public function create()
    {

        
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['News', route('admin.news.index')],
            ['Create', route('admin.blog-list.create')],
        ];
        $data = LifeAtAbrecoBanner::first();

        return view('admin.life-abreco.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'nullable',
            'sub_title' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',


        ]);
        $data = LifeAtAbrecoBanner::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->sub_title = $validated['sub_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/testimonials/image/', $validated['image']->getClientOriginalName(), 'public');
            $data->image = $path;
        }
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
}
