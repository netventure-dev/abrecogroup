<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\IndustryContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class IndustriesContentController extends Controller
{
    public function index( $id)
    {
        $industries= Industry::where('uuid',$id)->first();
        $contents =  IndustryContent::where('industries_id',$industries->uuid)->get();
        $content = '';
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('industries')),  route('admin.industries.index')],
            [$industries->name, null],
        ];
// dd( $industries );

        return view('admin.industries.content.index',compact('industries','breadcrumbs','contents'));
    }

    public function create($id)
    {
        $industries= Industry::where('uuid',$id)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Industries')), route('admin.industries.index')],
            [$industries->name, route('admin.industries.content.index',@$industries->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.industries.content.create',compact('industries','breadcrumbs'));
    }

    public function store(Request $request, $id)
    {
        $industries= Industry::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'sub_title' => 'nullable',
            'content' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',

            'order' => 'required|numeric',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]); 
        $content = new IndustryContent();
        $content->uuid = (string) Str::uuid();
        $content->industries_id = $industries->uuid;
        $content->title =  $validated['title'];
        $content->subtitle = $validated['sub_title'];
        $content->content = $validated['content'];
        $content->description =  $validated['description'];
        $content->order =  $validated['order'];
        $content->button_title =  $validated['button_title'];
        
        $content->button_link =  $validated['button_link'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $content->image = $path;
        }

        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/image',  $validated['mobile_image']->getClientOriginalName(), 'public');
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
        $industries= Industry::where('uuid',$id)->first();
        $content = IndustryContent::where('uuid',$uuid)->first();
        // dd($content);
        // $content_list = ServiceContentList::where('service_content_id',$content->uuid)->get();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Industry')), route('admin.industries.index')],
            [$industries->name, route('admin.industries.content.index',$industries->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.industries.content.edit',compact('industries','breadcrumbs','content',));
    }

    
    public function update(Request $request, $id,$uuid)
    {
        $industries= Industry::where('uuid',$id)->first();
        $content = IndustryContent::where('uuid',$uuid)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'sub_title' => 'nullable',
            'content' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',

            'order' => 'required|numeric',
            'status' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]); 

        // $content = new ServiceContent();
        // $content->service_id = $services->uuid;
        $content->title =  $validated['title'];
        $content->subtitle = $validated['sub_title'];
        $content->content = $validated['content'];
        $content->description =  $validated['description'];
        $content->order =  $validated['order'];
        $content->button_title =  $validated['button_title'];
        $content->status = $validated['status'];
        $content->button_link =  $validated['button_link'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $content->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/image',  $validated['mobile_image']->getClientOriginalName(), 'public');
            $content->mobile_image = $path;
        }
        $res = $content->save();

        // if($request->list){
        //     $content_list = ServiceContentList::where('service_content_id',$content->uuid)->delete();     
        //     foreach($request->list as $list){
        //         if($list){              
                  
        //             $content_list = new ServiceContentList();
        //             $content_list->uuid = (string) Str::uuid();
        //             $content_list->service_id = $services->uuid;
        //             $content_list->service_content_id = $content->uuid;
        //             $content_list->data = $list;
        //             $content_list->save();
        //         }

        //     }
        // }
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
        $res = IndustryContent::where('uuid',$uuid)->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
