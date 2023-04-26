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
        $services= Service::where('uuid',$id)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.services.index')],
            [$services->title, null],
            [(__('Content')), null],
        ];
        return view('admin.services.content.create',compact('services','breadcrumbs'));
    }

    public function store(Request $request, $id)
    {
        $services= Service::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'order' => 'required|numeric',
            'image_position' => 'required',
            'button_title' => 'nullable',
            
            'button_link' => 'nullable',
        ]); 

        $content = new SubServiceContent();
        $content->uuid = (string) Str::uuid();
        $content->service_id = $services->uuid;
        $content->title =  $validated['title'];
        $content->description =  $validated['description'];
        $content->order =  $validated['order'];
        $content->image_position =  $validated['image_position'];
        $content->button_title =  $validated['button_title'];
        
        $content->button_link =  $validated['button_link'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $content->image = $path;
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
        $services= Service::where('uuid',$id)->first();
        $content = SubServiceContent::where('uuid',$uuid)->first();
        $content_list = SubServiceContentList::where('service_content_id',$content->uuid)->get();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.services.index')],
            [$services->title, route('admin.services.content.index',$services->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.services.content.edit',compact('services','breadcrumbs','content','content_list'));
    }

    
    public function update(Request $request, $id,$uuid)
    {
        $services= Service::where('uuid',$id)->first();
        $content = SubServiceContent::where('uuid',$uuid)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'order' => 'required|numeric',
            'image_position' => 'required',
            'status' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]); 

        // $content = new SubServiceContent();
        // $content->service_id = $services->uuid;
        $content->title =  $validated['title'];
        $content->description =  $validated['description'];
        $content->order =  $validated['order'];
        $content->image_position =  $validated['image_position'];
        $content->button_title =  $validated['button_title'];
        $content->status = $validated['status'];
        $content->button_link =  $validated['button_link'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $content->image = $path;
        }
        $res = $content->save();

        if($request->list){
            $content_list = SubServiceContentList::where('service_content_id',$content->uuid)->delete();     
            foreach($request->list as $list){
                if($list){              
                  
                    $content_list = new SubServiceContentList();
                    $content_list->uuid = (string) Str::uuid();
                    $content_list->service_id = $services->uuid;
                    $content_list->service_content_id = $content->uuid;
                    $content_list->data = $list;
                    $content_list->save();
                }

            }
        }
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
}
