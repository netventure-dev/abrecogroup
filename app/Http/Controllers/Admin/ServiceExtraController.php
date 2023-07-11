<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ServiceContent;
use App\Models\ServiceExtra;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceExtraController extends Controller
{
    public function index($id)
    {
        $service = ServiceContent::where('uuid', $id)->first();
        $service_data = Service::where('uuid', $service->service_id)->first();
        $contents = ServiceExtra::where('service_content_id', $service->uuid)->get();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.services.index')],
            [$service_data->title, route('admin.services.content.index',$service_data->uuid)],
             [$service->title, route('admin.services.content.index', $service->service_id)],
            [(__('Service Extras')),null],
        ];
        
        
        // dd( $services );
        // dd($contents);

        return view('admin.services.content.extra.index', compact('service', 'contents', 'breadcrumbs'));
    }
    public function create($id)
    {
        $service = ServiceContent::where('uuid', $id)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.services.index')],
             [$service->title, route('admin.services.content.index', $service->service_id)],
            [(__('Services Extra')), route('admin.services.extra.index', $service->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.services.content.extra.create', compact('service','breadcrumbs'));
    }

    public function store(Request $request, $id)
    {
        $service = ServiceContent::where('uuid', $id)->first();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2000',
            'order' => 'required|numeric',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]);

        $content = new ServiceExtra();
        $content->uuid = (string) Str::uuid();
        $content->service_content_id = $service->uuid;
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
        
        $service = ServiceContent::where('uuid', $id)->first();
        $content = ServiceExtra::where('uuid', $uuid)->first();
        $service_data = Service::where('uuid', $service->service_id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.services.index')],
            [$service_data->title, route('admin.services.content.index',$service_data->uuid)],
            [$service->title, route('admin.services.content.index', $service->service_id)],
            [(__('Service Extras')), route('admin.services.extra.index', $service->uuid)],
            [$content->title, null],
        ];
        return view('admin.services.content.extra.edit', compact('service', 'content', 'breadcrumbs'));
    }


    public function update(Request $request, $id, $uuid)
    {
        $service = ServiceContent::where('uuid', $id)->first();
        $content = ServiceExtra::where('uuid', $uuid)->first();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2000',
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
        $res = ServiceExtra::where('uuid', $uuid)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
