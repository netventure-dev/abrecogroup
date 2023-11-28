<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerSettings;
use Illuminate\Support\Str;

class CareerOpeningSettingsController extends Controller
{
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Career Opening Settings', route('admin.contact-us.create')],
        ];
        $career = CareerSettings::first();
        return view('admin.career-opening.settings.create', compact('breadcrumbs','career'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required',
            'canonical_tag' =>'nullable',
            'sub_title' => 'nullable',
            'banner_image' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'seo_title' => 'nullable',
            'seo_keywords' => 'nullable',
            'seo_description' => 'nullable',
        ]);
        $data = CareerSettings::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->canonical_tag = $validated['canonical_tag'];

        $data->title = $validated['title'];
        $data->sub_title = $validated['sub_title'];
        $data->seo_title = $validated['seo_title'];
        $data->seo_keywords = $validated['seo_keywords'];
        $data->seo_description = $validated['seo_description'];
        if ($request->hasFile('banner_image')) {
            $path =  $request->file('banner_image')->storeAs('media/aboutus/image',$validated['banner_image']->getClientOriginalName(), 'public');
            $data->banner_image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/aboutus/image',$validated['mobile_image']->getClientOriginalName(), 'public');
            $data->mobile_image = $path;
        }
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function image_delete(Request $request)
    {

        $data = CareerSettings::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->banner_image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }

    public function image_delete1(Request $request)
    {

        $data = CareerSettings::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->mobile_image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }

}
