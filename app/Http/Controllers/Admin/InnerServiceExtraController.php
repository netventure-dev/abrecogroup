<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\InnerServiceContent;
use App\Models\InnerServiceExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InnerServiceExtraController extends Controller
{
    public function index($id)
    {
        $service = InnerServiceContent::where('uuid', $id)->first();
        $contents = InnerServiceExtra::where('inner_service_content_id', $service->uuid)->get();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Inner Services')), route('admin.inner-services.index')],
             [$service->title, route('admin.inner-services.content.index', $service->inner_service_id)],
            [(__('Inner Service Extras')),null],
        ];
        
        
        // dd( $services );
        // dd($contents);

        return view('admin.inner-services.content.extra.index', compact('service', 'contents', 'breadcrumbs'));
    }
    public function create($id)
    {
        $service = InnerServiceContent::where('uuid', $id)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Inner Services')), route('admin.inner-services.index')],
             [$service->title, route('admin.inner-services.content.index', $service->inner_service_id)],
            [(__('Inner Services Extra')), route('admin.inner-services.extra.index', $service->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.inner-services.content.extra.create', compact('service','breadcrumbs'));
    }

    public function store(Request $request, $id)
    {
        $service = InnerServiceContent::where('uuid', $id)->first();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'section' => 'required',

            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'order' => [
                'required',
                Rule::unique('inner_service_extras', 'order')->where(function ($query) use ($id) {
                    return $query->where('inner_service_content_id', $id);
                })->ignore($service->id),
            ],
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]);

        $content = new InnerServiceExtra();
        $content->uuid = (string) Str::uuid();
        $content->inner_service_content_id = $service->uuid;
        $content->title =  $validated['title'];
        $content->description =  $validated['description'];
        $content->section =  $validated['section'];

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
        
        $service = InnerServiceContent::where('uuid', $id)->first();
        $content = InnerServiceExtra::where('uuid', $uuid)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Inner Services')), route('admin.inner-services.index')],
             [$service->title, route('admin.inner-services.content.index', $service->inner_service_id)],
            [(__('Inner Service Extras')), route('admin.inner-services.extra.index', $service->uuid)],
            [$content->title, null],
        ];
        return view('admin.inner-services.content.extra.edit', compact('service', 'content', 'breadcrumbs'));
    }


    public function update(Request $request, $id, $uuid)
    {
        $service = InnerServiceContent::where('uuid', $id)->first();
        $content = InnerServiceExtra::where('uuid', $uuid)->first();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'section' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'order' => [
                'required',
                Rule::unique('inner_service_extras', 'order')
                    ->where(function ($query) use ($id) {
                        return $query->where('inner_service_content_id', $id);
                    })
                    ->ignore($content->uuid, 'uuid'), // Replace $serviceContentId with the actual ID of the record being updated
            ],
            'status' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]);

        // $content = new InnerServiceContent();
        // $content->service_id = $services->uuid;
        $content->title =  $validated['title'];
        $content->description =  $validated['description'];
        $content->order =  $validated['order'];
        $content->section =  $validated['section'];
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
        $res = InnerServiceExtra::where('uuid', $uuid)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    public function image_delete(Request $request)
    {
        
        $section = InnerServiceExtra::where('uuid',$request->uuid)->first();
        $section->image = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
}
