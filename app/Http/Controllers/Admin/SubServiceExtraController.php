<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubServiceContent;
use App\Models\SubServiceExtra;
use App\Models\SubService;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class SubServiceExtraController extends Controller
{

    public function index($id)
    {
        $subservice = SubServiceContent::where('uuid', $id)->first();
        $contents = SubServiceExtra::where('sub_service_content_id', $subservice->uuid)->get();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Sub Services')), route('admin.sub-services.index')],
             [$subservice->title, route('admin.sub-services.content.index', $subservice->sub_service_id)],
            [(__('Sub Services Extra')),null],
        ];
        
        
        // dd( $services );
        // dd($contents);

        return view('admin.sub-services.content.extra.index', compact('subservice', 'contents', 'breadcrumbs'));
    }
    public function create($id)
    {
        $subservice = SubServiceContent::where('uuid', $id)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Sub Services')), route('admin.sub-services.index')],
             [$subservice->title, route('admin.sub-services.content.index', $subservice->sub_service_id)],
            [(__('Sub Services Extra')), route('admin.sub-services.extra.index', $subservice->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.sub-services.content.extra.create', compact('subservice','breadcrumbs'));
    }

    public function store(Request $request, $id)
    {
        $subservice = SubServiceContent::where('uuid', $id)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'order' => 'required|numeric',
            'button_title' => 'nullable',

            'button_link' => 'nullable',
        ]);

        $content = new SubServiceExtra();
        $content->uuid = (string) Str::uuid();
        $content->sub_service_content_id = $subservice->uuid;
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


    public function edit($id, $uuid)
    {
        
        $subservice = SubServiceContent::where('uuid', $id)->first();
        $content = SubServiceExtra::where('uuid', $uuid)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Sub Services')), route('admin.sub-services.index')],
             [$subservice->title, route('admin.sub-services.content.index', $subservice->sub_service_id)],
            [(__('Sub Services Extra')), route('admin.sub-services.extra.index', $subservice->uuid)],
            [$content->title, null],
        ];
        return view('admin.sub-services.content.extra.edit', compact('subservice', 'content', 'breadcrumbs'));
    }


    public function update(Request $request, $id, $uuid)
    {
        $subservice = SubServiceContent::where('uuid', $id)->first();
        $content = SubServiceExtra::where('uuid', $uuid)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'order' => 'required|numeric',
            'status' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]);

        // $content = new SubServiceContent();
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
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy($id, $uuid)
    {
        // $this->authorize('delete', $menu);
        // $res = Service::where('uuid',$id);
        $res = SubServiceExtra::where('uuid', $uuid)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

}
