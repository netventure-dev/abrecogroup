<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SalesDifficultyDataTable;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\SaleDifficulty;
use Illuminate\Http\Request;

class SalesDifficultyController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(SalesDifficultyDataTable $dataTable)
    {
        // $this->authorize('viewAny', Admin::class);
        $user = auth()->guard('admin')->user();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Sales Difficulty', route('admin.sales-difficulty.index')],
        ];
        return $dataTable->render('admin.sales_difficulty.index', ['user' => $user, 'breadcrumbs' =>$breadcrumbs]);
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
            ['Sales Difficulty', route('admin.sales-difficulty.index')],
            ['Create', route('admin.sales-difficulty.create')],
        ];
        return view('admin.sales_difficulty.create', compact('breadcrumbs'));
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
            'name' => 'required|string|max:255',
            'point' => 'required',
        ]);
        $data = new SaleDifficulty();
        $data->name = $validated['name'];
        $data->point = $validated['point'];
        $data->save();
        if ($data) {
            activity('admin')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Sales Difficulty #' . $data->name . '.');
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
        $sales = SaleDifficulty::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Sales Difficulty', route('admin.sales-difficulty.index')],
            [$sales->name, null],
        ];
        return view('admin.sales_difficulty.edit', compact('sales','breadcrumbs'));
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
        $data = SaleDifficulty::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'point' => 'required',
        ]);
        $data->name = $validated['name'];
        $data->point = $validated['point'];
        $data->save();
        if ($data) {
            // $role = Role::findById($validated['role']);
            // $admin->assignRole($role);
            // $data['name'] = $admin->name;
            // $data['email'] = $admin->email;
            // $data['password'] = $validated['password'];
            // $data['url'] =  route('admin.login');
            // Notification::send($admin, new AdminAdd($data));
            activity('admin')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created sales difficulty #' . $data->name . '.');
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
        $data = SaleDifficulty::whereid($id)->firstorFail();
        // $this->authorize('delete', $data);
        $res = $data->delete();
        if ($res) {
            activity('admin')->performedOn($data)->causedBy($data)->log('Deleted sales difficulty #' . $data->name . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

}
