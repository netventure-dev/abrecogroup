<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InnerService;
use App\Models\InnerServiceContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class InnerServiceContentController extends Controller
{

    public function index($id)
    {
        $subservice = InnerService::where('uuid', $id)->first();
        $contents = InnerServiceContent::where('inner_service_id', $subservice->uuid)->get();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.inner-services.index')],
            ['Inner Services', route('admin.inner-services.index')],
            [$subservice->title, null],
        ];
        // dd( $services );

        return view('admin.inner-services.content.index', compact('subservice', 'contents', 'breadcrumbs'));
    }
    public function create($id)
    {
        $subservice = InnerService::where('uuid', $id)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.inner-services.index')],
             [$subservice->title, route('admin.inner-services.content.index', $subservice->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.inner-services.content.create', compact('subservice', 'breadcrumbs'));
    }


    public function store(Request $request, $id)
    {
        $subservice = InnerService::where('uuid', $id)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'order' => 'required|numeric',
            // 'alt_text' => 'nullable',
            'button_title' => 'nullable',


            'button_link' => 'nullable',
        ]);

        $content = new InnerServiceContent();
        $content->uuid = (string) Str::uuid();
        $content->inner_service_id = $subservice->uuid;
        $content->title =  $validated['title'];
        // $content->alt_text =  $validated['alt_text'];

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
        $content_list = '';
        $subservice = InnerService::where('uuid', $id)->first();
        $content = InnerServiceContent::where('uuid', $uuid)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.inner-services.index')],
             [$subservice->name, route('admin.inner-services.content.index', $subservice->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.inner-services.content.edit', compact('subservice', 'content', 'breadcrumbs'));
    }


    public function update(Request $request, $id, $uuid)
    {
        $subservice = InnerService::where('uuid', $id)->first();
        $content = InnerServiceContent::where('uuid', $uuid)->first();
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
        $res = InnerServiceContent::where('uuid', $uuid)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

}