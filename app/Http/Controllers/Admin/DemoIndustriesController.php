<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DemoIndustryDataTable;
use App\Http\Controllers\Controller;
use App\Models\DemoIndustry;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DemoIndustriesController extends Controller
{
    public function index(DemoIndustryDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Demo industries')), null],
        ];
        return $dataTable->render('admin.demo_industries.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Demo Industries', route('admin.demo_industries.index')],
            ['Create', route('admin.demo_industries.create')],
        ];
        return view('admin.demo_industries.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required|unique:demo_industries,title',
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
        $service = new DemoIndustry();
        $service->uuid = (string) Str::uuid();
        $service->slug = SlugService::createSlug(DemoIndustry::class, 'slug', $validated['title'], ['unique' => false]);
        $service->title = $validated['title'];
        $service->content = $validated['content'];
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

    
    public function edit($id)
    {
        $services= DemoIndustry::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Industry')),  route('admin.industries.index')],
            [$services->title, null],
    ];
        return view('admin.demo_industries.edit', compact('breadcrumbs','services'));
    }

    public function update(Request $request,$id)
    {
        
        $services = DemoIndustry::where('uuid',$id)->first();

        $validated = $request->validate([
            'title' => 'required|unique:demo_industries,title,'.$services->id,
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
        $services->slug = SlugService::createSlug(DemoIndustry::class, 'slug', $validated['title'], ['unique' => false]);
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

    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = DemoIndustry::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }


}
