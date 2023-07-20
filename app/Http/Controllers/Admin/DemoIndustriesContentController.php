<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemoIndustry;
use App\Models\DemoIndustryContent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DemoIndustriesContentController extends Controller
{
    public function index($id)
    {
        $industries= DemoIndustry::where('uuid',$id)->first();
        $contents =  DemoIndustryContent::where('industries_id',$industries->uuid)->get();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Demo industries')), null],
            [$industries->name, null],
        ];
        return view('admin.demo_industries.content.index',compact('industries','breadcrumbs','contents'));
    }
    public function create($id)
    {
        // $this->authorize('create', Admin::class);
        $industries= DemoIndustry::where('uuid',$id)->first();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Demo Industries', route('admin.demo_industries.index')],
            [$industries->title, route('admin.demo_industries.content.index',@$industries->uuid)],
            ['Create', route('admin.demo_industries.create')],
        ];
        return view('admin.demo_industries.content.create', compact('breadcrumbs','industries'));
    }

    public function store(Request $request, $id)
    {
        $industries= DemoIndustry::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:demo_industry_contents,title',
            'sub_title' => 'nullable',
            'content' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'link' => 'nullable',
            'button_title' => 'nullable',
            'status' => 'required',
            'order' => 'nullable',
        ]);
        $service = new DemoIndustryContent();
        $service->uuid = (string) Str::uuid();
        $service->slug = SlugService::createSlug(DemoIndustryContent::class, 'slug', $validated['title'], ['unique' => false]);
        $service->title = $validated['title'];
        $service->content = $validated['content'];
        $service->industries_id = $industries->uuid;
        $service->description = $validated['description'];
        $service->order = $validated['order'];
        $service->status = $validated['status'];  
        $service->subtitle = $validated['sub_title'];
        $service->button_link = $validated['link'];
        $service->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $service->image1 = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/image',  $validated['mobile_image']->getClientOriginalName(), 'public');
            $service->mobile_image = $path;
        }  
        $res = $service->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

    
    public function edit($id,$uuid)
    {
        $services= DemoIndustry::where('uuid',$id)->first();
        $content = DemoIndustryContent::where('uuid',$uuid)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            ['Demo Industries', route('admin.demo_industries.index')],
            [$services->title, route('admin.demo_industries.content.index',@$services->uuid)],
            ['Edit', null],
    ];
        return view('admin.demo_industries.content.edit', compact('breadcrumbs','services','content'));
    }

    public function update(Request $request,$id,$uuid)
    {
        $industries= DemoIndustry::where('uuid',$id)->first();
        $services = DemoIndustryContent::where('uuid',$uuid)->first();

        $validated = $request->validate([
            'title' => 'required|unique:demo_industry_contents,title,'.$services->id,
            'sub_title' => 'nullable',
            'content' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'link' => 'nullable',
            'button_title' => 'nullable',
            'status' => 'required',
            'order' => 'nullable',
        ]);
        $services->slug = SlugService::createSlug(DemoIndustryContent::class, 'slug', $validated['title'], ['unique' => false]);
        $services->title = $validated['title'];
        $services->content = $validated['content'];
        $services->description = $validated['description'];
        $services->order = $validated['order'];
        $services->status = $validated['status'];  
        $services->subtitle = $validated['sub_title'];
        $services->button_link = $validated['link'];
        $services->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $services->image1 = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/image',  $validated['mobile_image']->getClientOriginalName(), 'public');
            $services->mobile_image = $path;
        }  
        $res = $services->save();
        if ($res) {
            notify()->success(__('Updated Successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy($id,$uuid)
    {
        // $this->authorize('delete', $menu);
        $res = DemoIndustryContent::where('uuid',$uuid)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }


}
