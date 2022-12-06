<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\OwnerDataTable as AdminOwnerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\SaleDifficulty;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminOwnerDataTable $dataTable)
    {
        $owner = Owner::get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.owner.index')],
            ['Create', route('admin.owner.create')],
        ];
        return $dataTable->render('admin.owner.index', ['owner' => $owner, 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = SaleDifficulty::get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.kms.index')],
            ['Create', route('admin.kms.create')],
        ];
        return view('admin.owner.create', compact('breadcrumbs', 'datas'));
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
            'no_of_owners' => 'required|string|max:255',
            'status' => 'required',
            'difficulty_id' => 'required',
        ]);
        $owner = new Owner();
        $owner->no_of_owners = $validated['no_of_owners'];
        $owner->status = $validated['status'];
        $owner->difficulty_id = $validated['difficulty_id'];

        $owner->save();
        if ($owner) {
            activity('data')->performedOn($owner)->causedBy($owner)->withProperties(['data' => $request])->log('Created  #' . $owner->name . '.');
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
        $datas = SaleDifficulty::get();
        $owner = Owner::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.owner.index')],
            [$owner->name, null],
        ];
        return view('admin.owner.edit', compact('owner', 'breadcrumbs', 'datas'));
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
        $owner = Owner::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'no_of_owners' => 'required|string|max:255',
            'status' => 'required',
            'difficulty_id' => 'required',
        ]);
        $owner->no_of_owners = $validated['no_of_owners'];
        $owner->status = $validated['status'];
        $owner->difficulty_id = $validated['difficulty_id'];
        $owner->save();
        if ($owner) {
            activity('owner')->performedOn($owner)->causedBy($owner)->withProperties(['data' => $request])->log('Created  #' . $owner->name . '.');
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
        $owner = Owner::whereid($id)->firstorFail();
        // $this->authorize('delete', $admin);
        $res = $owner->delete();
        if ($res) {
            activity('fuel')->performedOn($owner)->causedBy($owner)->log('Deleted  #' . $owner->name . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
