<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ServiceFaqDataTable;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceFaq;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class ServiceFaqController extends Controller
{
    public function index(ServiceFaqDataTable $dataTable, $id)
    {
        $services= Service::where('uuid',$id)->first();
        $faqs = ServiceFaq::where('service_id',$services->uuid)->get();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')),  route('admin.services.index')],
            [$services->title, null],
        ];
        // dd( $services );
        return $dataTable->render('admin.services.faq.index', ['breadcrumbs' => $breadcrumbs,'services' => $services]);
    }

    public function create($id)
    {
        $services= Service::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.services.index')],
            [$services->title, null],
            [(__('Faq')), null],
        ];
        return view('admin.services.faq.create',compact('services','breadcrumbs'));
    }

    public function store(Request $request, $id)
    {
        $services= Service::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp | max:2000',
            'order' => 'required|numeric',
            'image_position' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]); 

        $faq = new ServiceFaq();
        $faq->uuid = (string) Str::uuid();
        $faq->service_id = $services->uuid;
        $faq->title =  $validated['title'];
        $faq->description =  $validated['description'];
        $faq->order =  $validated['order'];
        $faq->image_position =  $validated['image_position'];
        $faq->button_title =  $validated['button_title'];
        $faq->button_link =  $validated['button_link'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $faq->image = $path;
        }
        $res = $faq->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();


    }

    public function edit($id,$uuid)
    {
        $services= Service::where('uuid',$id)->first();
        $faq = ServiceFaq::where('uuid',$uuid)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.services.index')],
            [$services->title, route('admin.services.faq.index',$services->uuid)],
            [(__('Faq')), null],
        ];
        return view('admin.services.faq.edit',compact('services','breadcrumbs','faq'));
    }

    
    public function update(Request $request, $id,$uuid)
    {
        $services= Service::where('uuid',$id)->first();
        $faq = ServiceFaq::where('uuid',$uuid)->first();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp | max:2000',
            'order' => 'required|numeric',
            'image_position' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]); 

        // $faq = new ServiceFaq();
        // $faq->service_id = $services->uuid;
        $faq->title =  $validated['title'];
        $faq->description =  $validated['description'];
        $faq->order =  $validated['order'];
        $faq->image_position =  $validated['image_position'];
        $faq->button_title =  $validated['button_title'];
        $faq->button_link =  $validated['button_link'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $faq->image = $path;
        }
        $res = $faq->save();
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
        $res = ServiceFaq::where('uuid',$uuid)->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
