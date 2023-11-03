<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\IndustryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class IndustriesController extends Controller
{
    public function index(IndustryDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('industries')), null],
        ];
        return $dataTable->render('admin.industries.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Industries', route('admin.industries.index')],
            ['Create', route('admin.industries.create')],
        ];
        return view('admin.industries.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|unique:industries,name',
            'sub_title' => 'nullable',
            'canonical_tag' => 'nullable',
            'custom_url' => 'nullable',
            'content' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'icon' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'link' => 'nullable',
            'button_title' => 'nullable',
            'status' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
            'order' => 'nullable',
        ]);
        $service = new Industry();
        $service->uuid = (string) Str::uuid();
        $service->slug = SlugService::createSlug(Industry::class, 'slug', $validated['name'], ['unique' => false]);
        $service->name = $validated['name'];
        $service->canonical_tag = $validated['canonical_tag'];
        $service->content = $validated['content'];
        $service->custom_url = $validated['custom_url'];
        $service->order = $validated['order'];
        $service->status = $validated['status'];  
        $service->seo_title = $validated['seo_title'];
        $service->seo_description = $validated['seo_description'];
        $service->seo_keywords = $validated['seo_keywords'];
        $service->subtitle = $validated['sub_title'];
        $service->link = $validated['link'];
        $service->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $service->image = $path;
        }
        if ($request->hasFile('icon')) {
            $path =  $request->file('icon')->storeAs('media/image',  $validated['icon']->getClientOriginalName(), 'public');
            $service->icon = $path;
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
        $services= Industry::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Industry')),  route('admin.industries.index')],
            [$services->name, null],
    ];
        return view('admin.industries.edit', compact('breadcrumbs','services'));
    }

    public function update(Request $request,$id)
    {
        
        $services = Industry::where('uuid',$id)->first();

        $validated = $request->validate([
            'name' => 'required|unique:industries,name,'.$services->id,
            'sub_title' => 'nullable',
            'canonical_tag' => 'nullable',
            'content' => 'nullable',
            'custom_url' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'icon' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'link' => 'nullable',
            'button_title' => 'nullable',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
            'status' => 'required',
            'order' => 'nullable',
        ]);
        $services->slug = SlugService::createSlug(Industry::class, 'slug', $validated['name'], ['unique' => false]);
        $services->name = $validated['name'];
        $services->canonical_tag = $validated['canonical_tag'];

        $services->content = $validated['content'];
        $services->order = $validated['order'];
        $services->status = $validated['status'];   
        $services->custom_url = $validated['custom_url'];
        $services->subtitle = $validated['sub_title'];
        $services->seo_title = $validated['seo_title'];
        $services->seo_description = $validated['seo_description'];
        $services->seo_keywords = $validated['seo_keywords'];
        $services->link = $validated['link'];
        $services->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $services->image = $path;
        }
        if ($request->hasFile('icon')) {
            $path =  $request->file('icon')->storeAs('media/image',  $validated['icon']->getClientOriginalName(), 'public');
            $services->icon = $path;
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
        $res = Industry::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }


}
