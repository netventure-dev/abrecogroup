<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SchemaDataTable;
use App\Http\Controllers\Controller;
use App\Models\SchemaMarkup;
use App\Models\InnerServiceExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SchemaController extends Controller
{
    public function index(SchemaDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Schema')), null],
        ];
        return $dataTable->render('admin.schema.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Schema', route('admin.schema.index')],
            [(__('Create')),  null],
        ];
        return view('admin.schema.create', compact('breadcrumbs'));
    }
    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required|unique:schema_markups,title',
            'content' => 'required',
            'status' => 'required'
        ]);
        $data = new SchemaMarkup;
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->description = $validated['content'];
        $data->status = $validated['status'];
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        // $this->authorize('update', $menu);
        $data= SchemaMarkup::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Schema')),  route('admin.schema.index')],
            [$data->title, null],
    ];
        return view('admin.schema.edit', compact('breadcrumbs','data'));
    }
    public function update(Request $request,$id)
    {
        // $this->authorize('create', Gender::class);
        $data= SchemaMarkup::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:schema_markups,title,'.$data->id,
            'content' => 'required',
            'status' => 'required'

        ]);
        $data->title = $validated['title'];
        $data->description = $validated['content'];
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
        $res = SchemaMarkup::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
