<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MilestoneSettingDataTable; // Correct this line if necessary
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MilestoneSetting;

class MilestoneSettingsController extends Controller
{
    public function index(MilestoneSettingDataTable $dataTable) // Correct this line if necessary
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Milestone')), null],
        ];
        return $dataTable->render('admin.milestone.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
        ];
        $data = MilestoneSetting::first();
        return view('admin.milestone.create', ['breadcrumbs' => $breadcrumbs, 'data' => $data]);
        // return view('admin.milestone.list.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required',
            'color' => 'required|array',
        ]);
        $homeSlider = new MilestoneSetting();
        $homeSlider->title = $validatedData['title'];
        $homeSlider->status = $validatedData['status'];
        $homeSlider->color = serialize($validatedData['color']);

        $res = $homeSlider->save();

        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id)
    {  
        
        $milestone = MilestoneSetting::where('uuid', $id)->first();
        $milestone->color = unserialize($milestone->color);
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Milestone Settings')), route('admin.milestone.settings.index')],
            [(__('Milestone')), null],
        ];
        return view('admin.milestone.edit', compact('milestone','breadcrumbs'));
    }

    public function update(Request $request,$id)
    {
        $milestone = MilestoneSetting::where('uuid', $id)->first();

        $validatedData = $request->validate([
            'title' => 'required',
            'status' => 'required',
            'color' => 'required|array',
        ]);
        $milestone ->title = $validatedData['title'];
        $milestone ->status = $validatedData['status'];
        $milestone ->color = serialize($validatedData['color']);

        $res = $milestone->save();

        if ($res) {
            notify()->success(__('updated successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        $res = MilestoneSetting::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
