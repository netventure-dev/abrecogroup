<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdminDataTable;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AdminAdd;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Admin;
use App\Notifications\AdminUpdated;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTable $dataTable)
    {
        // $this->authorize('viewAny', Admin::class);
        $user = auth()->guard('admin')->user();
        // dd($user)
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.administrator.index')],
        ];
        return $dataTable->render('admin.administrators.index', ['user' => $user, 'breadcrumbs' =>$breadcrumbs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.administrator.index')],
            ['Create', route('admin.administrator.create')],
        ];
        return view('admin.administrators.create', compact('roles','breadcrumbs'));
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
            'email' => 'required|string|email|max:255|unique:admins,email,NULL,id,deleted_at,NULL',
            'password' => 'required|string|min:8',
            // 'role' => 'required',
            'avatar' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $admin = new Admin();
        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->password = Hash::make($validated['password']);
        if ($request->hasFile('avatar')) {
            $path =  $request->file('avatar')->storeAs(
                'media/images/profile',
                urlencode(time()) . '_' . $admin->name . $request->avatar->getClientOriginalName(),
                'public'
            );
            $admin->avatar = $path;
        }
        $admin->save();
        if ($admin) {
            // $role = Role::findById($validated['role']);
            // $admin->assignRole($role);
            // $data['name'] = $admin->name;
            // $data['email'] = $admin->email;
            // $data['password'] = $validated['password'];
            // $data['url'] =  route('admin.login');
            // Notification::send($admin, new AdminAdd($data));
            activity('admin')->performedOn($admin)->causedBy($admin)->withProperties(['data' => $request])->log('Created Administrator #' . $admin->name . '.');
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::whereUuid($id)->firstorFail();
        // $this->authorize('update', $admin);
        return redirect()->route('admin.administrators.edit', $admin->uuid);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Administrator', route('admin.administrator.index')],
            [$admin->name, null],
        ];
        return view('admin.administrators.edit', compact('admin','roles','breadcrumbs'));
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
        $admin = Admin::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id . ',id,deleted_at,NULL',
            'password' => 'nullable|string|min:8',
            'role' => 'required',
            'avatar' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        if (isset($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }
        if ($request->hasFile('avatar')) {
            Storage::delete($admin->avatar);
            $path =  $request->file('avatar')->storeAs(
                'media/images/profile',
                urlencode(time()) . '_' . $admin->name . $request->avatar->getClientOriginalName(),
                'public'
            );
            $admin->avatar = $path;
        }
        $admin->save();
        if ($admin) {
            $role = Role::findById($validated['role']);
            $admin->assignRole($role);
            // $data['name'] = $admin->name;
            // $data['email'] = $admin->email;
            // $data['password'] = $validated['password'];
            // $data['url'] =  route('admin.login');
            // Notification::send($admin, new AdminAdd($data));
            activity('admin')->performedOn($admin)->causedBy($admin)->withProperties(['data' => $request])->log('Created Administrator #' . $admin->name . '.');
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
        $admin = Admin::whereid($id)->firstorFail();
        // $this->authorize('delete', $admin);
        $res = $admin->delete();
        if ($res) {
            Storage::delete($admin->avatar);
            activity('admin')->performedOn($admin)->causedBy($admin)->log('Deleted Administrator #' . $admin->name . '.');
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
