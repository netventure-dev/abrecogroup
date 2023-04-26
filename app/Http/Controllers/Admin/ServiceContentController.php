<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceContent;
use App\Models\ServiceContentList;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class ServiceContentController extends Controller
{
    public function index( $id)
    {
        $services= Service::where('uuid',$id)->first();
        $contents = ServiceContent::where('service_id',$services->uuid)->get();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')),  route('admin.services.index')],
            [$services->title, null],
        ];
// dd( $services );

        return view('admin.services.content.index',compact('services','breadcrumbs','contents'));
    }

    public function create($id)
    {
        $services= Service::where('uuid',$id)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.services.index')],
            [$services->title, route('admin.services.content.index',$services->uuid)],
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
            'button_title' => 'nullable',
            
            'button_link' => 'nullable',
        ]); 

        $content = new ServiceContent();
        $content->uuid = (string) Str::uuid();
        $content->service_id = $services->uuid;
        $content->title =  $validated['title'];
        $content->description =  $validated['description'];
        $content->order =  $validated['order'];
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
        $content = ServiceContent::where('uuid',$uuid)->first();
        $content_list = ServiceContentList::where('service_content_id',$content->uuid)->get();

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
        $content = ServiceContent::where('uuid',$uuid)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'order' => 'required|numeric',
            'status' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]); 

        // $content = new ServiceContent();
        // $content->service_id = $services->uuid;
        $content->title =  $validated['title'];
        $content->description =  $validated['description'];
        $content->order =  $validated['order'];
        $content->button_title =  $validated['button_title'];
        $content->status = $validated['status'];
        $content->button_link =  $validated['button_link'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $content->image = $path;
        }
        $res = $content->save();

        if($request->list){
            $content_list = ServiceContentList::where('service_content_id',$content->uuid)->delete();     
            foreach($request->list as $list){
                if($list){              
                  
                    $content_list = new ServiceContentList();
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
        $res = ServiceContent::where('uuid',$uuid)->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
