<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ScheduleDataTable;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Schedule;
use App\Models\Bundle;
use App\Models\Rod;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(ScheduleDataTable $dataTable)
    {
        // $this->authorize('viewAny', Admin::class);
        $user = auth()->guard('admin')->user();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Schedule', route('admin.schedule.index')],
        ];
        return $dataTable->render('admin.schedule.index', ['user' => $user, 'breadcrumbs' =>$breadcrumbs]);
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
            ['Schedule', route('admin.schedule.index')],
            ['Create', route('admin.schedule.create')],
        ];
        return view('admin.schedule.create', compact('breadcrumbs'));
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
            'venue' => 'required',
            'speaker' => 'nullable',
            'topic' => 'nullable',
            'schedule_date' => 'nullable|date',
            'schedule_time' => 'nullable|date_format:g:i A',
            'status' => 'required',
        ]);
        $data = new Schedule();
        $data->venue = $validated['venue'];
        $data->speakers = $validated['speaker'];
        $data->topic = $validated['topic'];
        $data->schedule_date = date('Y-m-d', strtotime($validated['schedule_date']));
        $data->schedule_time = $validated['schedule_time'];
        $data->status = $validated['status'];
        $data->save();
        if ($data) {
            activity('admin')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Schedule #' . $data->venue . '.');
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
        $schedule = Schedule::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        // $roles = Role::all();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Schedule', route('admin.schedule.index')],
            [$schedule->name, null],
        ];
        return view('admin.schedule.edit', compact('schedule','breadcrumbs'));
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
        $data = Schedule::whereid($id)->firstorFail();
        // $this->authorize('update', $admin);
        $validated = $this->validate($request, [
            'venue' => 'required',
            'speaker' => 'nullable',
            'topic' => 'nullable',
            'schedule_date' => 'nullable|date',
            'schedule_time' => 'nullable|date_format:g:i A',
            'status' => 'required',
        ]);
        $data->venue = $validated['venue'];
        $data->speakers = $validated['speaker'];
        $data->topic = $validated['topic'];
        $data->schedule_date = date('Y-m-d', strtotime($validated['schedule_date']));
        $data->schedule_time = $validated['schedule_time'];
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
            activity('admin')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Schedule #' . $data->venue . '.');
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }
}
