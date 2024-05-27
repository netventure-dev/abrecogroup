<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ServiceCareDataTable;
use App\Http\Controllers\Controller;
use App\Models\ServiceCare;
use Illuminate\Support\Str;
use JoeDixon\Translation\Language;
use Illuminate\Http\Request;

class ServiceCareController extends Controller
{
    public function index(ServiceCareDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Service Care')), null],
        ];
        return $dataTable->render('admin.service-care.index', ['breadcrumbs' => $breadcrumbs]);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Service Care', route('admin.service-care.index')],
            ['Create', route('admin.service-care.create')],
        ];
        return view('admin.service-care.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'name' => 'required|unique:service_cares,name',
            'status' => 'required',
        ]);
        $data = new ServiceCare;
        $data->uuid = (string) Str::uuid();
        $data->name = $validated['name'];
        $data->status = $validated['status'];
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created Successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        // $this->authorize('update', $menu);
        $data= ServiceCare::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Service Care')),  route('admin.service-care.index')],
            [$data->title, null],
        ];
        return view('admin.service-care.edit', compact('breadcrumbs','data'));
    }
    public function update(Request $request,$id)
    {
        // $this->authorize('create', Gender::class);
        $data= ServiceCare::where('uuid',$id)->first();
        $validated = $request->validate([
            'name' => 'required|unique:service_cares,name,'.$data->id,
            'status' => 'required',
        ]);
        $data->name = $validated['name'];
        $data->status = $validated['status'];
        $res = $data->save();
        if ($res) {
            notify()->success(__('Updated Successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = ServiceCare::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted Successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
