<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\InnerServiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\InnerService;
use App\Models\SubService;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class InnerServiceController extends Controller
{
    public function index(InnerServiceDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Inner Services')), null],
        ];
       
        return $dataTable->render('admin.inner-services.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Inner Services', route('admin.inner-services.index')],
            ['Create', route('admin.inner-services.create')],
        ];
        $subservices=SubService::where('status',1)->get();
        return view('admin.inner-services.create', compact('breadcrumbs','subservices'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:inner_services,name',
            'cover_description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'title' => 'required',
            'alt_text' => 'nullable',
            'description' => 'required',
            'sub_service_id' => 'required',
            'status' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $sub_service_name=SubService::where('uuid',$validated['sub_service_id'])->first();
        $service_data=Service::where('uuid',$sub_service_name->service_id)->first();
        $service = new InnerService();
        $service->uuid = (string) Str::uuid();
        $service->name = $validated['name'];
        $service->alt_text = $validated['alt_text'];

        $service->slug = SlugService::createSlug(InnerService::class, 'slug', $validated['name'], ['unique' => false]);
        $service->cover_description = $validated['cover_description'];
        $service->status = $validated['status'];  
        $service->title = $validated['title'];
        $service->description = $validated['description'];
        $service->sub_service_id = $validated['sub_service_id'];
        $service->subservice = @$sub_service_name->name;
        $service->sub_service_slug = @$sub_service_name->slug;
        $service->service_id = @$service_data->uuid;
        $service->service_name = @$service_data->name;
        $service->service_slug = @$service_data->slug;
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
        $innerservice= InnerService::where('uuid',$id)->first();
        $breadcrumbs = [
                [(__('Dashboard')), route('admin.home')],
                [(__('Inner Services')),  route('admin.inner-services.index')],
                [$innerservice->name, null],
        ];
        $subservices=SubService::where('status',1)->get();
        return view('admin.inner-services.edit', compact('breadcrumbs','innerservice','subservices'));
    }

    public function update(Request $request,$id)
    {
        
        $services = InnerService::where('uuid',$id)->first();

        $validated = $request->validate([
            'name' => 'required|unique:inner_services,name,'.$services->id,
            'cover_description' => 'required',
            'image' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
            'logo' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
            'alt_text' => 'nullable',
            'title' => 'required',
            'sub_service_id' => 'required',
            'description' => 'required',
            'status' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $sub_service_name=SubService::where('uuid',$validated['sub_service_id'])->first();
        $service_data=Service::where('uuid',$sub_service_name->service_id)->first();
        $services->name = $validated['name'];
        $services->alt_text = $validated['alt_text'];

        $services->slug = SlugService::createSlug(SubService::class, 'slug', $validated['name'], ['unique' => false]);
        $services->cover_description = $validated['cover_description'];
        $services->status = $validated['status'];  
        $services->title = $validated['title'];
        $services->sub_service_id = $validated['sub_service_id'];
        $services->service_id = @$service_data->uuid;
        $services->subservice = @$sub_service_name->name;
        $services->sub_service_slug = @$sub_service_name->slug;
        $services->service_name = @$service_data->name;
        $services->service_slug = @$service_data->slug;
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
        $res = InnerService::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
