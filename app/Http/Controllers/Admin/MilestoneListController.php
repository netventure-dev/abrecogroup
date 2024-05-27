<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MilestoneListDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MilestoneSetting;
use App\Models\MilestoneList;

class MilestoneListController extends Controller
{
    public function index(MilestoneListDataTable $dataTable) // Correct this line if necessary
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Milestone')), null],
        ];
        return $dataTable->render('admin.milestone.list.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Milestone List')), route('admin.milestone.list.index')],
            [(__('Milestone')), null],
        ];
        $data = MilestoneSetting::get();
        $change=MilestoneList::first();
        return view('admin.milestone.list.create', ['breadcrumbs' => $breadcrumbs, 'data' => $data,'change'=> $change]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'milestone' => 'required',
            'description' => 'nullable',
            'logo' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
        ]);
        $milestone = new MilestoneList();
        $milestone->title = $validatedData['title'];
        $milestone->milestone_id = $validatedData['milestone'];
        $milestone->description = $validatedData['description'];
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/logo',  $validatedData['logo']->getClientOriginalName(), 'public');
            $milestone->logo = $path;
        }

        $res = $milestone->save();

        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id)
    {  
        
        $milestone = MilestoneList::where('uuid', $id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Milestone List')), route('admin.milestone.list.index')],
            [(__('Milestone')), null],
        ];
        // $services=Service::where('status',1)->get();
        $data = MilestoneSetting::where('status',1)->get();
        return view('admin.milestone.list.edit', compact('milestone','breadcrumbs','data'));
    }

    public function update(Request $request,$id)
    {
        $milestone = MilestoneList::where('uuid', $id)->first();

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'milestone' => 'required',
            'description' => 'nullable',
            'logo' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
        ]);
        $milestone->title = $validatedData['title'];
        $milestone->milestone_id = $validatedData['milestone'];
        $milestone->description = $validatedData['description'];
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/logo',  $validatedData['logo']->getClientOriginalName(), 'public');
            $milestone->logo = $path;
        }

        $res = $milestone->save();

        if ($res) {
            notify()->success(__('Updated  successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
      
    return redirect()->back();
    }
    public function destroy($id)
    {
        $res = MilestoneList::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

}
