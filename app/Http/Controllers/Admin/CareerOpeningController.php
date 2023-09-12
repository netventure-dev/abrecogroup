<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\Admin\CareerOpeningDataTable;
use App\Http\Controllers\Controller;
use App\Models\CareerOpening;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CareerOpeningController extends Controller
{
    public function index(CareerOpeningDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Career')), null],
        ];
        return $dataTable->render('admin.career-opening.index', ['breadcrumbs' => $breadcrumbs]);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Career', route('admin.career-opening.index')],
            ['Create', route('admin.career-opening.create')],
        ];
        return view('admin.career-opening.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'position' => 'required',
            'description' => 'nullable',
            'experience' => 'nullable',
            'status' => 'required',
        ]);
        $career = new CareerOpening;
        $career->uuid = (string) Str::uuid();
        $career->position = $validated['position'];
        $career->description = $validated['description'];
        $career->experience = $validated['experience'];
        $career->status = $validated['status'];
        $res = $career->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id)
    {

        $career= CareerOpening::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('career')),  route('admin.career-opening.index')],
            [$career->position, null],
    ];
        return view('admin.career-opening.edit', compact('breadcrumbs','career'));
    }
    public function update(Request $request,$id)
    {
        // $this->authorize('create', Gender::class);
        $career= CareerOpening::where('uuid',$id)->first();
        $validated = $request->validate([
            'position' => 'required',
            'description' => 'nullable',
            'experience' => 'nullable',
            'status' => 'required',
        ]);
        $career->position = $validated['position'];
        $career->description = $validated['description'];
        $career->experience = $validated['experience'];
        $career->status = $validated['status'];
        $res = $career->save();
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = CareerOpening::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
