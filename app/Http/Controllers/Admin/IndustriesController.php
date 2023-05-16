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
            'status' => 'required',
        ]);
        $service = new Industry();
        $service->uuid = (string) Str::uuid();
        $service->slug = SlugService::createSlug(Industry::class, 'slug', $validated['name'], ['unique' => false]);
        $service->name = $validated['name'];
        $service->status = $validated['status'];  
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
            'status' => 'required',
        ]);
        $services->slug = SlugService::createSlug(Industry::class, 'slug', $validated['name'], ['unique' => false]);
        $services->name = $validated['name'];
        $services->status = $validated['status'];          
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
