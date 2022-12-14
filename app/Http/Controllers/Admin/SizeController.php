<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SizeDataTable;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(SizeDataTable $dataTable)
    {
        // $this->authorize('viewAny', Admin::class);
        $user = auth()->guard('admin')->user();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Size', route('admin.size.index')],
        ];
        return $dataTable->render('admin.size.index', ['user' => $user, 'breadcrumbs' =>$breadcrumbs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        // $this->authorize('create', Admin::class);
        $sizes= Size::where('status',1)->get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Size', route('admin.size.index')],
            ['Create', route('admin.size.create')],
        ];
        return view('admin.size.create', compact('breadcrumbs'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        // $this->authorize('create', Admin::class);
        $validated = $this->validate($request, [
            'size' => 'required|unique:sizes',
            'status' => 'required',
        ]);
        $data = new Size();
        $data->size = $validated['size'];
        $data->status = $validated['status'];
        $data->save();
        if ($data) {
            activity('admin')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Size #' . $data->size . '.');
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        $size = Size::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Size', route('admin.size.index')],
            [$size->name, null],
        ];
        return view('admin.size.edit', compact('size','breadcrumbs'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
    {
        $data = Size::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'size' => 'required|unique:sizes,size,'.$id,
            'status' => 'required',
        ]);
        $data->size = $validated['size'];
        $data->status = $validated['status'];
        $data->save();
        if ($data) {
            // $role = Role::findById($validated['role']);
            // $admin->assignRole($role);
            // $data['name'] = $admin->name;
            // $data['email'] = $admin->email;
            // $data['password'] = $validated['password'];
            // $data['url'] =  route('admin.login');
            // Notification::send($admin, new AdminAdd($data));
            activity('admin')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Size #' . $data->name . '.');
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $data = Size::whereid($id)->firstorFail();
        // $this->authorize('delete', $data);
        $res = $data->delete();
        if ($res) {
            activity('admin')->performedOn($data)->causedBy($data)->log('Deleted Size #' . $data->size . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

}
