<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DifficultyDataTable as AdminDifficultyDataTable;
use App\DataTables\DifficultyDataTable;
use App\Http\Controllers\Controller;
use App\Models\Difficulty;
use App\Models\SaleDifficulty;
use Illuminate\Http\Request;

class DifficultyController extends Controller
{
    public function index(AdminDifficultyDataTable $dataTable)
    {
        $difficulties = Difficulty::get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.administrator.index')],
            ['Create', route('admin.administrator.create')],
        ];
        return $dataTable->render('admin.difficulty.index', ['difficulties' => $difficulties, 'breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        $datas= SaleDifficulty::get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator'],
            ['Create', route('admin.difficulty.create')],
        ];
        return view('admin.difficulty.create', compact('breadcrumbs','datas'));
    }
    public function store(Request $request)
    {
        // $this->authorize('create', Admin::class);
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'difficulties' => 'required',
        ]);
        $data = new Difficulty();
        $data->name = $validated['name'];
        $data->status = $validated['status'];
        $data->difficulties = $validated['difficulties'];

        $data->save();
        if ($data) {
            activity('data')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Administrator #' . $data->name . '.');
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $datas = SaleDifficulty::get();
        $admin = Difficulty::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.difficulty.index')],
            [$admin->name, null],
        ];
        return view('admin.difficulty.edit', compact('admin', 'breadcrumbs', 'datas'));
    }

    public function update(Request $request, $id)
    {
        $admin = Difficulty::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'difficulties' => 'required',
        ]);
        $admin->name = $validated['name'];
        $admin->status = $validated['status'];
        $admin->difficulties = $validated['difficulties'];
        $admin->save();
        if ($admin) {
            activity('admin')->performedOn($admin)->causedBy($admin)->withProperties(['data' => $request])->log('Created Administrator #' . $admin->name . '.');
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $admin = Difficulty::whereid($id)->firstorFail();
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
