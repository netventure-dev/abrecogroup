<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BrandDataTable;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\SaleDifficulty;
use App\Models\Brand;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(BrandDataTable $dataTable)
    {
        // $this->authorize('viewAny', Admin::class);
        $user = auth()->guard('admin')->user();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Brands', route('admin.brands.index')],
        ];
        return $dataTable->render('admin.brands.index', ['user' => $user, 'breadcrumbs' =>$breadcrumbs]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        // $this->authorize('create', Admin::class);
        $datas= SaleDifficulty::get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.brands.index')],
            ['Create', route('admin.brands.create')],
        ];
        return view('admin.brands.create', compact('breadcrumbs','datas'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Admin::class);
        $validated = $this->validate($request, [
            'name' => 'required|string|unique:brands|max:255',
            'status' => 'required',
            'difficulties' => 'required',
        ]);
        $data = new Brand();
        $data->name = $validated['name'];
        $data->status = $validated['status'];
        $data->difficulty_id= $validated['difficulties'];
        $data->save();
        if ($data) {
            activity('data')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created brand #' . $data->name . '.');
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
   /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        $brand = Brand::whereid($id)->firstorFail();
        $datas= SaleDifficulty::get();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Brands', route('admin.brands.index')],
            [$brand->name, null],
        ];
        return view('admin.brands.edit', compact('brand','breadcrumbs','datas'));
    }

    public function update(Request $request,$id)
    {
        // $this->authorize('create', Admin::class);
        $data =  Brand::whereid($id)->firstorFail();
        $validated = $this->validate($request, [
            'name' => 'required|string|unique:brands,name,'.$id,
            'status' => 'required',
            'difficulties' => 'required',
        ]);
        $data->name = $validated['name'];
        $data->status = $validated['status'];
        $data->difficulty_id= $validated['difficulties'];
        $data->save();
        if ($data) {
            activity('data')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created brand #' . $data->name . '.');
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $brand = Brand::whereid($id)->firstorFail();
        // $this->authorize('delete', $admin);
        $res = $brand->delete();
        if ($res) {
            activity('admin')->performedOn($brand)->causedBy($brand)->log('Deleted brand #' . $brand->name . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
