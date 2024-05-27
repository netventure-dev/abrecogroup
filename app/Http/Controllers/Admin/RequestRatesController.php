<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Models\RequestRateSetting;
use Illuminate\Support\Str;

class RequestRatesController extends Controller
{
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Request Rate Setting', route('admin.request.settings.create')],
        ];
        $data = RequestRateSetting::first();
        return view('admin.request.settings.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'cover_title' => 'required',
            'cover_content' => 'required',
            'cover_image' => 'required|mimes:jpg,jpeg,png,webp|max:2000',
            'link' => 'nullable',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
        ]);
        $data = RequestRateSetting::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->cover_title = $validated['cover_title'];
        $data->cover_content = $validated['cover_content'];
        $data->link = $validated['link'];
        $data->seo_title = $validated['seo_title'];
        $data->seo_keywords = $validated['seo_keyword'];
        $data->seo_description = $validated['seo_description'];
        if ($request->hasFile('cover_image')) {
            $path =  $request->file('cover_image')->storeAs('media/request/image/',$validated['cover_image']->getClientOriginalName(), 'public');
            $data->cover_image = $path;
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
