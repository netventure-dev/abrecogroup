<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RodDataTable;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Rod;
use App\Models\Size;
use Illuminate\Http\Request;

class RodController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(RodDataTable $dataTable)
    {
        $rods = Rod::get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.rods.index')],
            ['Create', route('admin.rods.create')],
        ];
        return $dataTable->render('admin.rods.index', ['rods' => $rods, 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Rod::get();
        $sizes= Size::where('status',1)->get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Rods', route('admin.rods.index')],
            ['Create', route('admin.rods.create')],
        ];
        return view('admin.rods.create', compact('breadcrumbs', 'datas','sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'rods' => 'required',
            'size_id' => 'required',
            'weight' => 'required',
            'rate' => 'nullable',
            'status' => 'required',
        ]);
        $data = new Rod();
        $data->no_of_rods = $validated['rods'];
        $data->status = $validated['status'];
        $data->size_id = $validated['size_id'];
        $data->weight = $validated['weight'];
        $data->rate = $validated['rate'];
        $data->save();
        if ($data) {
            activity('data')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created  #' . $data->no_of_rods . '.');
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rod = Rod::where('id',$id)->first();
        $sizes= Size::where('status',1)->get();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Rods', route('admin.rods.index')],
    ];
        return view('admin.rods.edit', compact('sizes', 'breadcrumbs', 'rod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Rod::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'rods' => 'required',
            'size_id' => 'required',
            'weight' => 'required',
            'rate' => 'nullable',
            'status' => 'required',
        ]);
        $data->no_of_rods = $validated['rods'];
        $data->status = $validated['status'];
        $data->size_id = $validated['size_id'];
        $data->weight = $validated['weight'];
        $data->rate = $validated['rate'];
        $data->save();
        if ($data) {
            activity('admin')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created  #' . $data->no_of_rods . '.');
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
        $rod = Rod::whereid($id)->firstorFail();
        // $this->authorize('delete', $admin);
        $res = $rod->delete();
        if ($res) {
            activity('fuel')->performedOn($rod)->causedBy($rod)->log('Deleted  #' . $rod->no_of_rods . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
