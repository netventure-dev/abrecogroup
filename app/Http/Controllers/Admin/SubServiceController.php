<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SubServiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\SubService;
use App\Models\InnerService;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SubServiceController extends Controller
{
    public function index(SubServiceDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Sub Services')), null],
        ];
       
        return $dataTable->render('admin.sub-services.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Sub Services', route('admin.sub-services.index')],
            ['Create', route('admin.sub-services.create')],
        ];
        $services=Service::where('status',1)->get();
        return view('admin.sub-services.create', compact('breadcrumbs','services'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:sub_services,name|max:255',
            'cover_description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'title' => 'required|max:255',
            'canonical_tag' => 'nullable',
            'custom_url' => 'nullable',
            'description' => 'nullable',
            'service_id' => 'required',
            'status' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $service_name=Service::where('uuid',$validated['service_id'])->first();
        $service = new SubService();
        $service->uuid = (string) Str::uuid();
        $service->name = $validated['name'];
        $service->slug = SlugService::createSlug(SubService::class, 'slug', $validated['name'], ['unique' => false]);
        $service->cover_description = $validated['cover_description'];
        $service->status = $validated['status'];  
        $service->title = $validated['title'];
        $service->canonical_tag = $validated['canonical_tag'];

        $service->custom_url = $validated['custom_url'];
        $service->description = $validated['description'];
        $service->service_id = $validated['service_id'];
        $service->service = $service_name->name;
        $service->service_slug = $service_name->slug;
        $service->seo_title = $validated['seo_title'];
        $service->seo_description = $validated['seo_description'];
        $service->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $service->cover_image = $path;
        }
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/image',  $validated['logo']->getClientOriginalName(), 'public');
            $service->logo = $path;
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
        $subservice= SubService::where('uuid',$id)->first();
        $breadcrumbs = [
                [(__('Dashboard')), route('admin.home')],
                [(__('Sub Services')),  route('admin.sub-services.index')],
                [$subservice->name, null],
        ];
        $services=Service::where('status',1)->get();
        return view('admin.sub-services.edit', compact('breadcrumbs','services','subservice'));
    }

    public function update(Request $request,$id)
    {
        
        $services = SubService::where('uuid',$id)->first();

        $validated = $request->validate([
            'name' => 'required|max:255,',
            'cover_description' => 'required',
            'image' => 'sometimes|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'logo' => 'sometimes|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'title' => 'required|max:255',
            'canonical_tag' => 'nullable',
            'custom_url' => 'nullable',
            'service_id' => 'required',
            'description' => 'nullable',
            'status' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $service_name=Service::where('uuid',$validated['service_id'])->first();
        $services->name = $validated['name'];
        $services->slug = SlugService::createSlug(SubService::class, 'slug', $validated['name'], ['unique' => false]);
        $services->cover_description = $validated['cover_description'];
        $services->status = $validated['status'];  
        $services->title = $validated['title'];
        $services->canonical_tag = $validated['canonical_tag'];

        $services->custom_url = $validated['custom_url'];
        $services->service_id = $validated['service_id'];
        $services->service = $service_name->name;
        $services->service_slug = $service_name->slug;
        $services->description = $validated['description'];
        $services->seo_title = $validated['seo_title'];
        $services->seo_description = $validated['seo_description'];
        $services->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $services->cover_image = $path;
        }
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/logo',  $validated['logo']->getClientOriginalName(), 'public');
            $services->logo = $path;
        }
        $res = $services->save();
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = SubService::where('uuid',$id)->delete();
        $inerservice=InnerService::where('sub_service_id',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    public function image_delete(Request $request)
    {
        
        $section = SubService::where('uuid',$request->uuid)->first();
        $section->cover_image = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
    public function image_delete1(Request $request)
    {
        
        $section = SubService::where('uuid',$request->uuid)->first();
        $section->logo = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
}
