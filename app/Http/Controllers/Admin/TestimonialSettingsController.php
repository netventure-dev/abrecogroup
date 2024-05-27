<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Models\TestimonialSetting;
use Illuminate\Support\Str;

class TestimonialSettingsController extends Controller
{
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Testimonial Settings',null],
        ];
        $data = TestimonialSetting::first();
        return view('admin.testimonials.settings.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required',
            'logo' => 'sometimes|required| max:2000',
        ]);
        $data = TestimonialSetting::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
       
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/aboutus/image',$validated['logo']->getClientOriginalName(), 'public');
            $data->logo = $path;
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
