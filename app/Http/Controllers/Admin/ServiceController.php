<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ServicesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceController extends Controller
{
    public function index(ServicesDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), null],
        ];
        return $dataTable->render('admin.services.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Services', route('admin.services.index')],
            ['Create', route('admin.services.create')],
        ];
        return view('admin.services.create', compact('breadcrumbs'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:services,name',
            'cover_description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp | max:2000',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $service = new Service();
        $service->uuid = (string) Str::uuid();
        $service->slug = SlugService::createSlug(Service::class, 'slug', $validated['name'], ['unique' => false]);
        $service->name = $validated['name'];
        $service->cover_description = $validated['cover_description'];
        $service->status = $validated['status'];  
        $service->title = $validated['title'];
        $service->description = $validated['description'];
        $service->seo_title = $validated['seo_title'];
        $service->seo_description = $validated['seo_description'];
        $service->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $service->cover_image = $path;
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
        $services= Service::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')),  route('admin.services.index')],
            [$services->title, null],
    ];
        return view('admin.services.edit', compact('breadcrumbs','services'));
    }

    public function update(Request $request,$id)
    {
        
        $services = Service::where('uuid',$id)->first();

        $validated = $request->validate([
            'name' => 'required|unique:services,name,'.$services->id,
            'cover_description' => 'required',
            'image' => 'sometimes|mimes:jpg,jpeg,png,webp | max:2000',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $services->name = $validated['name'];
        $services->slug = SlugService::createSlug(Service::class, 'slug', $validated['name'], ['unique' => false]);
        $services->cover_description = $validated['cover_description'];
        $services->status = $validated['status'];  
        $services->title = $validated['title'];
        $services->description = $validated['description'];
        $services->seo_title = $validated['seo_title'];
        $services->seo_description = $validated['seo_description'];
        $services->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $services->cover_image = $path;
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
        $res = Service::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

}