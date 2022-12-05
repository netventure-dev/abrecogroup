<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\KmDataTable as AdminKmDataTable;
use App\DataTables\DifficultyDataTable;
use App\Http\Controllers\Controller;
use App\Models\Difficulty;
use App\Models\Km;
use App\Models\SaleDifficulty;
use Illuminate\Http\Request;

class KmsController extends Controller
{
    public function index(AdminKmDataTable $dataTable)
    {
        $kms = Km::get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.kms.index')],
            ['Create', route('admin.kms.create')],
        ];
        return $dataTable->render('admin.kms.index', ['kms' => $kms, 'breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        $datas= SaleDifficulty::get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator',route('admin.kms.index')],
            ['Create', route('admin.kms.create')],
        ];
        return view('admin.kms.create', compact('breadcrumbs','datas'));
    }
    public function store(Request $request)
    {
        // $this->authorize('create', Admin::class);
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'difficulty_id' => 'required',
        ]);
        $data = new Km();
        $data->name = $validated['name'];
        $data->status = $validated['status'];
        $data->difficulty_id = $validated['difficulty_id'];

        $data->save();
        if ($data) {
            activity('data')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created  #' . $data->name . '.');
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $datas = SaleDifficulty::get();
        $admin = Km::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.kms.index')],
            [$admin->name, null],
        ];
        return view('admin.kms.edit', compact('admin', 'breadcrumbs', 'datas'));
    }

    public function update(Request $request, $id)
    {
        $admin = Km::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'difficulty_id' => 'required',
        ]);
        $admin->name = $validated['name'];
        $admin->status = $validated['status'];
        $admin->difficulty_id = $validated['difficulty_id'];
        $admin->save();
        if ($admin) {
            activity('admin')->performedOn($admin)->causedBy($admin)->withProperties(['data' => $request])->log('Created  #' . $admin->name . '.');
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $admin = Km::whereid($id)->firstorFail();
        // $this->authorize('delete', $admin);
        $res = $admin->delete();
        if ($res) {
            activity('admin')->performedOn($admin)->causedBy($admin)->log('Deleted  #' . $admin->name . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
