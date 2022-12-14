<?php


namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BundlesDataTable;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Rod;
use App\Models\Size;
use App\Models\Bundle;
use Illuminate\Http\Request;

class BundlesController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(BundlesDataTable $dataTable)
    {
        $datas = Bundle::get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Bundles', route('admin.bundles.index')],
            ['Create', route('admin.bundles.create')],
        ];
        return $dataTable->render('admin.bundles.index', ['datas' => $datas, 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Bundle::get();
        $sizes= Size::where('status',1)->get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Bundles', route('admin.bundles.index')],
            ['Create', route('admin.bundles.create')],
        ];
        return view('admin.bundles.create', compact('breadcrumbs', 'datas','sizes'));
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
            'bundles' => 'required',
            'rods' => 'required',
            'size_id' => 'required',
            'weight' => 'required',
            'rate' => 'nullable',
            'status' => 'required',
        ]);
        $data = new Bundle();
        $data->no_of_bundles = $validated['bundles'];
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
        $bundle = Bundle::where('id',$id)->first();
        $sizes= Size::where('status',1)->get();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Bundles', route('admin.bundles.index')],
    ];
        return view('admin.bundles.edit', compact('sizes', 'breadcrumbs', 'bundle'));
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
        $data = Bundle::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'bundles' => 'required',
            'rods' => 'required',
            'size_id' => 'required',
            'weight' => 'required',
            'rate' => 'nullable',
            'status' => 'required',
        ]);
        $data->no_of_bundles = $validated['bundles'];
        $data->no_of_rods = $validated['rods'];
        $data->status = $validated['status'];
        $data->size_id = $validated['size_id'];
        $data->weight = $validated['weight'];
        $data->rate = $validated['rate'];
        $data->save();
        if ($data) {
            activity('admin')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created  #' . $data->no_of_bundles . '.');
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
        $bundle = Bundle::whereid($id)->firstorFail();
        // $this->authorize('delete', $admin);
        $res = $bundle->delete();
        if ($res) {
            activity('fuel')->performedOn($bundle)->causedBy($bundle)->log('Deleted  #' . $bundle->no_of_bundles . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
