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
        $service_id= Service::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')),  route('admin.services.index')],
            [$service_id->title, null],
        ];
        // dd( $services );
        return $dataTable->with(['service_id' => $service_id])->render('admin.services.faq.index', ['breadcrumbs' => $breadcrumbs,'service_id' => $service_id]);
    }

    public function create($id)
    {
        $services= Service::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Services')), route('admin.services.index')],
            [(__('Faqs')), route('admin.services.faq.index',$services->uuid)],
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
            'order' => 'required|numeric',
            'status' => 'required',
        ]); 

        $faq = new ServiceFaq();
        $faq->uuid = (string) Str::uuid();
        $faq->service_id = $services->uuid;
        $faq->title =  $validated['title'];
        $faq->description =  $validated['description'];
        $faq->order =  $validated['order'];
        $faq->status = $validated['status'];  
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
            [$services->title, route('admin.services.faq.index', $services->uuid)],
            [(__('Faqs')), route('admin.services.faq.index',$services->uuid)],
            [$faq->title, null],
            

        ];
        return view('admin.services.faq.edit',compact('services','breadcrumbs','faq'));
    }

    
    public function update(Request $request, $id,$uuid)
    {
        $services= Service::where('uuid',$uuid)->first();
        $faq = ServiceFaq::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'order' => 'required|numeric',
            'status' => 'required',
        ]); 

        // $faq = new ServiceFaq();
        // $faq->service_id = $services->uuid;
        $faq->service_id = $services->uuid;
        $faq->title =  $validated['title'];
        $faq->description =  $validated['description'];
        $faq->order =  $validated['order'];
        $faq->status = $validated['status'];  
        $res = $faq->save();
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        // $res = Service::where('uuid',$id);
        $res = ServiceFaq::where('uuid',$id)->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
