<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Support\Str;
class ContactUsController extends Controller
{
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Contact Us', route('admin.contact-us.create')],
        ];
        $data = ContactUs::first();
        return view('admin.contact-us.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'address' => 'required',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'banner_image' => 'nullable|mimes:jpg,jpeg,png,webp | max:2000',
            'link' => 'nullable',
            'map_link' => 'nullable',
            'seo_title' => 'nullable',
            'seo_keywords' => 'nullable',
            'seo_description' => 'nullable',
        ]);
        $data = ContactUs::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->description = $validated['content'];
        $data->address = $validated['address'];
        $data->link = $validated['link'];
        $data->phone = $validated['phone'];
        $data->map_link = $validated['map_link'];
        $data->seo_title = $validated['seo_title'];
        $data->seo_keywords = $validated['seo_keywords'];
        $data->seo_description = $validated['seo_description'];
        if ($request->hasFile('banner_image')) {
            $path =  $request->file('banner_image')->storeAs('media/aboutus/image',$validated['banner_image']->getClientOriginalName(), 'public');
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
