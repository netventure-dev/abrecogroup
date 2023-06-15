<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CaseStudyDataTable;
use App\Models\CaseStudy;
use App\Models\Service;
use App\Models\SubService;
use App\Models\InnerService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CaseStudyController extends Controller
{
    public function index(CaseStudyDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Case Study')), null],
        ];
      
        return $dataTable->render('admin.casestudy.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Case Study', route('admin.casestudies.index')],
            ['Create', route('admin.casestudies.create')],
        ];
        $services= Service::get();
        return view('admin.casestudy.create', compact('breadcrumbs','services'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:case_studies,title',
            'service' => 'required',
            'sub_service' => 'nullable',
            'inner_service' => 'nullable',
            'content' => 'nullable',
            'content2' => 'nullable',
            'sub_title' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'b_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'link' => 'nullable',
            'button_title' => 'nullable',
            'status' => 'required',
            'order' => 'nullable',
        ]);
        $case = new CaseStudy();
        $case->uuid = (string) Str::uuid();
        $case->slug = SlugService::createSlug(CaseStudy::class, 'slug', $validated['title'], ['unique' => false]);
        $case->title = $validated['title'];
        $case->service_id = $validated['service'];
        $case->sub_service_id = $validated['sub_service'];
        $case->inner_service_id = $validated['inner_service'];
        $case->content = $validated['content'];
        $case->content2 = $validated['content2'];
        $case->order = $validated['order'];
        $case->status = $validated['status'];  
        $case->subtitle = $validated['sub_title'];
        $case->link = $validated['link'];
        $case->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $case->image1 = $path;
        }
        if ($request->hasFile('b_image')) {
            $path =  $request->file('b_image')->storeAs('media/image',  $validated['b_image']->getClientOriginalName(), 'public');
            $case->background_image = $path;
        }
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/image',  $validated['logo']->getClientOriginalName(), 'public');
            $case->image2 = $path;
        }
        $res = $case->save();
        if ($res) {
            notify()->success(__('Created Successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        $case= CaseStudy::where('uuid',$id)->first();
        $sub_services="";
        $inner_services="";
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Case Study', route('admin.casestudies.index')],
            [$case->title, null],
        ];
        $services= Service::get();
        $sub_services=SubService::where('service_id',@$case->service_id)->get();
        $inner_services=InnerService::where('sub_service_id',@$case->sub_service_id)->get();
        return view('admin.casestudy.edit', compact('breadcrumbs','case','services','sub_services','inner_services'));
    }
    public function update(Request $request,$id)
    {
        
        $case = CaseStudy::where('uuid',$id)->first();

        $validated = $request->validate([
            'title' => 'required|unique:case_studies,title,'.$case->id,
            'service' => 'required',
            'sub_service' => 'nullable',
            'inner_service' => 'nullable',
            'content' => 'nullable',
            'content2' => 'nullable',
            'sub_title' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'background_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'link' => 'nullable',
            'button_title' => 'nullable',
            'status' => 'required',
            'order' => 'nullable',
        ]);
        $case->slug = SlugService::createSlug(CaseStudy::class, 'slug', $validated['title'], ['unique' => false]);
        $case->title = $validated['title'];
        $case->service_id = $validated['service'];
        $case->sub_service_id = $validated['sub_service'];
        $case->inner_service_id = $validated['inner_service'];
        $case->content = $validated['content'];
        $case->content2 = $validated['content2'];
        $case->order = $validated['order'];
        $case->status = $validated['status'];
        $case->subtitle = $validated['sub_title'];
        $case->link = $validated['link'];
        $case->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $case->image1 = $path;
        }
        if ($request->hasFile('background_image')) {
            $path =  $request->file('background_image')->storeAs('media/image',  $validated['background_image']->getClientOriginalName(), 'public');
            $case->background_image = $path;
        }
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/image',  $validated['logo']->getClientOriginalName(), 'public');
            $case->image2 = $path;
        }
        $res = $case->save();
        if ($res) {
            notify()->success(__('Updated Successfully'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = CaseStudy::where('uuid',$id)->delete();
        // $content=SubService::where('section_id',$id)->first();
       
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    public function change_service(Request $request)
    {
        $data = SubService::where("service_id",$request->service)->get(); 
        return response()->json($data);  
  
    }
    public function change_subservice(Request $request)
    {
        $data = InnerService::where("sub_service_id",$request->subservice)->get(); 
        return response()->json($data);  
  
    }
}
