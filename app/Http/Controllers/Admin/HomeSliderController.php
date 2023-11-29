<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\HomeSliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Support\Str;
use JoeDixon\Translation\Language;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    public function index(HomeSliderDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Slider')), null],
        ];
        return $dataTable->render('admin.home-slider.index', ['breadcrumbs' => $breadcrumbs]);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Create', route('admin.home-slider.create')],
        ];
        $data = HomeSlider::first();
        return view('admin.home-slider.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required',
            'sub_title' => 'nullable',
            'canonical_tag' => 'nullable',
            'schema' => 'nullable',
            'button_title' => 'nullable',
            'content' => 'required',
            'link' => 'nullable',
            'image' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_slider' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
            // 'seo_title' => 'nullable',
            // 'seo_description' => 'nullable',
            // 'seo_keywords' => 'nullable',
        ]);
        $slider  = HomeSlider::firstOrCreate();
        // $slider = new HomeSlider;
        $slider->uuid = (string) Str::uuid();
        $slider->title = $validated['title'];
        $slider->sub_title = $validated['sub_title'];
        $slider->canonical_tag = $validated['canonical_tag'];
        $slider->schema = $validated['schema'];
        $slider->button_title = $validated['button_title'];
        $slider->link = $validated['link'];
        $slider->description = $validated['content'];
        // $slider->seo_title = $validated['seo_title'];
        // $slider->seo_description = $validated['seo_description'];
        // $slider->seo_keywords = $validated['seo_keywords'];
        $slider->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',$validated['image']->getClientOriginalName(), 'public');
            $slider->image = $path;
        }
        if ($request->hasFile('mobile_slider')) {
            $path =  $request->file('mobile_slider')->storeAs('media/image',$validated['mobile_slider']->getClientOriginalName(), 'public');
            $slider->mobile_slider = $path;
        }
        $res = $slider->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        // $this->authorize('update', $menu);
        $slider= HomeSlider::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Slider')),  route('admin.home-slider.index')],
            [$slider->title, null],
    ];
        return view('admin.home-slider.edit', compact('breadcrumbs','slider'));
    }
    public function update(Request $request,$id)
    {
        // $this->authorize('create', Gender::class);
        $slider= HomeSlider::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:home_sliders,title,'.$slider->id,
            'sub_title' => 'nullable',
            'button_title' => 'nullable',
            'canonical_tag' => 'nullable',
            'schema' => 'nullable',
            'content' => 'required',
            'link' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_slider' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
            // 'seo_title' => 'nullable',
            // 'seo_description' => 'nullable',
            // 'seo_keywords' => 'nullable',
        ]);
        $slider->title = $validated['title'];
        $slider->sub_title = $validated['sub_title'];
        $slider->button_title = $validated['button_title'];
        $slider->canonical_tag = $validated['canonical_tag'];
        $slider->schema = $validated['schema'];
        $slider->description = $validated['content'];
        $slider->status = $validated['status'];
        // $slider->seo_title = $validated['seo_title'];
        // $slider->seo_description = $validated['seo_description'];
        // $slider->seo_keywords = $validated['seo_keywords'];
        $slider->link = $validated['link'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image/', $validated['image']->getClientOriginalName(), 'public');
            $slider->image = $path;
        }
        if ($request->hasFile('mobile_slider')) {
            $path =  $request->file('mobile_slider')->storeAs('media/image/',$validated['mobile_slider']->getClientOriginalName(), 'public');
            $slider->mobile_slider = $path;
        }
        $res = $slider->save();
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = HomeSlider::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    public function image_delete(Request $request)
    {
        
        $section = HomeSlider::where('uuid',$request->uuid)->first();
        $section->image = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
    public function image_delete_one(Request $request)
    {
        
        $section = HomeSlider::where('uuid',$request->uuid)->first();
        $section->mobile_slider = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
}
