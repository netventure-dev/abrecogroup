<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\DataTables\Admin\RolesDataTable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, RolesDataTable $dataTable)
    {
        // $this->authorize('viewAny', Role::class);
        $breadcrumbs = [
            [__('Dashboard'), route('admin.home')],
            [__('Roles'), null]
        ];
        return $dataTable->render('admin.app.roles.index', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Role::class);
        $permissions = Permission::all();
        $breadcrumbs = [
            [__('Dashboard'), route('admin.home')],
            [__('Roles'), route('admin.roles.index')],
            [__('Create'), null]
        ];
        return view('admin.app.roles.create')->with(['permissions' => $permissions, 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Role::class);

        $data = $this->validate($request, [
            'name' => 'required|unique:roles|max:32',
            'permissions' => 'array',
        ]);

       
        $role = Role::create($data);
        // dd($data);

        $permissions = Permission::find($request->permissions);
        $role->syncPermissions($permissions);
        notify()->success(__('Created successfully'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('update', $role);
        return redirect()->route('admin.roles.edit', $role->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        $breadcrumbs = [
            [__('Dashboard'), route('admin.dashboard')],
            [__('Roles'), route('admin.roles.index')],
            [__('Edit'), null]
        ];
        $permissions = Permission::all();
        return view('admin.app.roles.edit')
            ->with('role', $role)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('permissions', $permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $data = $this->validate($request, [
            'name' => 'required|max:32|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        $role->update($data);

        $permissions = Permission::find($request->permissions);
        $role->syncPermissions($permissions);
        notify()->success(__('Updated successfully'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        notify()->success(__('Deleted successfully'));
        return redirect()->back();
    }
}
