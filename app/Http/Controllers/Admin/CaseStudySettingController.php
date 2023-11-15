<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\CaseStudySetting;

class CaseStudySettingController extends Controller
{
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $data= CaseStudySetting::first();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Case Study Setting', route('admin.case-study-settings.create')],
            // ['Create', route('admin.case-study-settings.create')],
        ];
        return view('admin.casestudy.settings', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
            'image' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
        ]);
        $data = CaseStudySetting::firstOrCreate();      
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->description = $validated['description'];
        $data->seo_title = $validated['seo_title'];
        $data->seo_keyword = $validated['seo_keyword'];
        $data->seo_description = $validated['seo_description'];
        
        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/data/image', $validated['image']->getClientOriginalName(), 'public');
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
