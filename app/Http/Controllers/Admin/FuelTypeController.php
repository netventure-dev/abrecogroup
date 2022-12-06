<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FuelDataTable as AdminFuelDataTable;
use App\Http\Controllers\Controller;
use App\Models\FuelType;
use App\Models\SaleDifficulty;
use Illuminate\Http\Request;

class FuelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminFuelDataTable $dataTable)
    {
        $fuel = FuelType::get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.fuel.index')],
            ['Create', route('admin.fuel.create')],
        ];
        return $dataTable->render('admin.fuel.index', ['fuel' => $fuel, 'breadcrumbs' => $breadcrumbs]);
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
                ['Administrator', route('admin.fuel.index')],
                ['Create', route('admin.fuel.create')],
            ];
            return view('admin.fuel.create', compact('breadcrumbs','datas'));
        
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
            'name' => 'required|string|max:255',
            'status' => 'required',
            'difficulty_id' => 'required',
        ]);
        $fuel = new FuelType();
        $fuel->name = $validated['name'];
        $fuel->status = $validated['status'];
        $fuel->difficulty_id = $validated['difficulty_id'];

        $fuel->save();
        if ($fuel) {
            activity('data')->performedOn($fuel)->causedBy($fuel)->withProperties(['data' => $request])->log('Created  #' . $fuel->name . '.');
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
        $fuel = FuelType::whereid($id)->firstorFail();
        $this->authorize('update', $fuel);
        return redirect()->route('admin.fuel.edit', $fuel->uuid);
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
        $fuel = FuelType::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.fuel.index')],
            [$fuel->name, null],
        ];
        return view('admin.fuel.edit', compact('fuel', 'breadcrumbs', 'datas'));
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
        $fuel = FuelType::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'difficulty_id' => 'required',
        ]);
        $fuel->name = $validated['name'];
        $fuel->status = $validated['status'];
        $fuel->difficulty_id = $validated['difficulty_id'];
        $fuel->save();
        if ($fuel) {
            activity('fuel')->performedOn($fuel)->causedBy($fuel)->withProperties(['data' => $request])->log('Created  #' . $fuel->name . '.');
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
        $fuel = FuelType::whereid($id)->firstorFail();
        // $this->authorize('delete', $admin);
        $res = $fuel->delete();
        if ($res) {
            activity('fuel')->performedOn($fuel)->causedBy($fuel)->log('Deleted  #' . $fuel->name . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    
}
