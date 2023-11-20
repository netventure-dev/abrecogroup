<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubServiceContent;
use App\Models\SubService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SubServiceContentController extends Controller
{
    public function index( $id)
    {
        $subservice= SubService::where('uuid',$id)->first();
        $contents = SubServiceContent::where('sub_service_id',$subservice->uuid)->get();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Sub Services')),  route('admin.sub-services.index')],
            [$subservice->name, null],
        ];
// dd( $services );

        return view('admin.sub-services.content.index',compact('subservice','breadcrumbs','contents'));
    }

    public function create($id)
    {
        $subservice= SubService::where('uuid',$id)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Sub Services')), route('admin.sub-services.index')],
            [$subservice->name , route('admin.sub-services.content.index',$subservice->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.sub-services.content.create',compact('subservice','breadcrumbs'));
    }

    public function store(Request $request, $id)
    {
        $subservice= SubService::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'sub_title' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'mobile_image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'order' => 'required|numeric',
            'button_title' => 'nullable',
            'status' => 'required',
            'inner_status' => 'required',
            'button_link' => 'nullable',
        ]); 

        $content = new SubServiceContent();
        $content->uuid = (string) Str::uuid();
        $content->sub_service_id = $subservice->uuid;
        $content->title =  $validated['title'];
        $content->sub_title =  $validated['sub_title'];
        $content->description =  $validated['description'];
        $content->order =  $validated['order'];
        $content->button_title =  $validated['button_title'];
        $content->button_link =  $validated['button_link'];
        $content->status =  $validated['status'];
        $content->inner_status =  $validated['inner_status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $content->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/mobile/image',  $validated['mobile_image']->getClientOriginalName(), 'public');
            $content->mobile_image = $path;
        }
        $res = $content->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();


    }

    public function edit($id,$uuid)
    {
        $content_list = '';
        $subservice= SubService::where('uuid',$id)->first();
        $content = SubServiceContent::where('uuid',$uuid)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.services.index')],
            [$subservice->name, route('admin.sub-services.content.index',$subservice->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.sub-services.content.edit',compact('subservice','breadcrumbs','content'));
    }

    
    public function update(Request $request, $id,$uuid)
    {
        $subservice= SubService::where('uuid',$id)->first();
        $content = SubServiceContent::where('uuid',$uuid)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'sub_title' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'mobile_image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'order' => 'required|numeric',
            'status' => 'required',
            'inner_status' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]); 

        // $content = new SubServiceContent();
        // $content->service_id = $services->uuid;
        $content->title =  $validated['title'];
        $content->sub_title =  $validated['sub_title'];
        $content->description =  $validated['description'];
        $content->order =  $validated['order'];
        $content->button_title =  $validated['button_title'];
        $content->status =  $validated['status'];
        $content->inner_status =  $validated['inner_status'];
        $content->button_link =  $validated['button_link'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $content->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/mobile/image',  $validated['mobile_image']->getClientOriginalName(), 'public');
            $content->mobile_image = $path;
        }
        $res = $content->save();
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy($id,$uuid)
    {
        // $this->authorize('delete', $menu);
        // $res = Service::where('uuid',$id);
        $res = SubServiceContent::where('uuid',$uuid)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    public function image_delete(Request $request)
    {
        
        $section = SubServiceContent::where('uuid',$request->uuid)->first();
        $section->image = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
    public function image_delete1(Request $request)
    {
        
        $section = SubServiceContent::where('uuid',$request->uuid)->first();
        $section->mobile_image = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
}
