<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SubModelDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\SaleDifficulty;
use App\Models\SubModel;
use Illuminate\Http\Request;

class SubModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubModelDataTable $dataTable )
    {
         // $this->authorize('viewAny', Admin::class);
         $user = auth()->guard('admin')->user();
         $breadcrumbs = [
             ['Dashboard', route('admin.home')],
             ['Sub Models', route('admin.sub-models.index')],
         ];
         return $dataTable->render('admin.sub-models.index', ['user' => $user, 'breadcrumbs' =>$breadcrumbs]);
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
       $brands = Brand::where('status',1)->get();
       $breadcrumbs = [
           ['Dashboard', route('admin.home')],
           ['Administrator', route('admin.sub-models.index')],
           ['Create', route('admin.sub-models.create')],
       ];
       return view('admin.sub-models.create', compact('breadcrumbs','datas','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Admin::class);
        $validated = $this->validate($request, [
            'name' => 'required|string|unique:brands|max:255',
            'status' => 'required',
            'difficulties' => 'required',
            'brand' => 'required',
        ]);
        $data = new SubModel();
        $data->name = $validated['name'];
        $data->status = $validated['status'];
        $data->brand_id = $validated['brand'];
        $data->difficulty_id= $validated['difficulties'];
        $data->save();
        if ($data) {
            activity('data')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Sub Model #' . $data->name . '.');
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subModels = SubModel::whereid($id)->firstorFail();
        $brands = Brand::where('status',1)->get();
        $datas= SaleDifficulty::get();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Sub Models', route('admin.sub-models.index')],
            [$subModels->name, null],
        ];
        return view('admin.sub-models.edit', compact('subModels','brands','breadcrumbs','datas'));
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $this->authorize('create', Admin::class);
        $data =  SubModel::whereid($id)->firstorFail();
        $validated = $this->validate($request, [
            'name' => 'required|string|unique:brands,name,'.$id,
            'status' => 'required',
            'difficulties' => 'required',
            'brand' => 'required',
        ]);
        $data->name = $validated['name'];
        $data->status = $validated['status'];
        $data->difficulty_id= $validated['difficulties'];
        $data->brand_id = $validated['brand'];
        $data->save();
        if ($data) {
            activity('data')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Updated Sub model #' . $data->name . '.');
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subModels = SubModel::whereid($id)->firstorFail();
        // $this->authorize('delete', $admin);
        $res = $subModels->delete();
        if ($res) {
            activity('admin')->performedOn($subModels)->causedBy($subModels)->log('Deleted Su$subModels #' . $subModels->name . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
