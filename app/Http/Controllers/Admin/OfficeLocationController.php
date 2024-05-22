<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\OfficeLocationDatatable;
use App\Http\Controllers\Controller;
use App\Models\OfficeLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class OfficeLocationController extends Controller
{

    public function index(OfficeLocationDatatable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('News')), null],
        ];
        return $dataTable->render('admin.office-location.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Office Location', route('admin.news.index')],
            ['Create', route('admin.blog-list.create')],
        ];
        return view('admin.office-location.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'sub_title' => 'nullable',
            'location_name' => 'nullable',
            'location_url' => 'nullable',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
        ]);
    
        $blogs = new OfficeLocation();
        $blogs->uuid = (string) Str::uuid();
        $blogs->title = $validated['title'];
        $blogs->sub_title = $validated['sub_title'] ?? null; 
        $blogs->location_name = $validated['location_name'] ?? null; 
        $blogs->location_url = $validated['location_url'] ?? null;
        $blogs->status = $validated['status'];
        // $blogs->slug = SlugService::createSlug(News::class, 'slug', $validated['title'], ['unique' => false]);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('media/location/image', $request->file('image')->getClientOriginalName(), 'public');
            $blogs->image = $path;
        }
    
        $res = $blogs->save();
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
        $blog = OfficeLocation::where('uuid', $id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Office Location')),  route('admin.office-location.index')],
            [$blog->title, null],
        ];
        return view('admin.office-location.edit', compact('breadcrumbs', 'blog'));
    }

    public function update(Request $request, $id)
    {
        // $this->authorize('create', Gender::class);
        $blog = OfficeLocation::where('uuid', $id)->first();
        $validated = $request->validate([
            'title' => 'required',
            'sub_title' => 'nullable',
            'location_name' => 'nullable',
            'location_url' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
           
        ]); 
        $blog->title = $validated['title'];
        $blog->sub_title = $validated['sub_title'] ?? null; 
        $blog->location_name = $validated['location_name'] ?? null; 
        $blog->location_url = $validated['location_url'] ?? null;
        $blog->status = $validated['status'];
        // $blog->slug = SlugService::createSlug(News::class, 'slug', $validated['title'], ['unique' => false]);
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image', $validated['image']->getClientOriginalName(), 'public');
            $blog->image = $path;
        }
        $res = $blog->save();
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
        $res = OfficeLocation::where('uuid', $id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }


}
