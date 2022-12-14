<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\GstDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gst;

class GSTController extends Controller
{
    // public function index(GstDataTable $dataTable)
    // {
    //     // $this->authorize('viewAny', Admin::class);
    //     $user = auth()->guard('admin')->user();
    //     $breadcrumbs = [
    //         ['Dashboard', route('admin.home')],
    //         ['gst', route('admin.gst.index')],
    //     ];
    //     return $dataTable->render('admin.gst.index', ['user' => $user, 'breadcrumbs' => $breadcrumbs]);
    // }
    
    public function create()
    {

        // $datas = Rod::get();
        // $sizes = Size::where('status', 1)->get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            // ['gst', route('admin.gst.index')],
        ];
        return view('admin.gst.create',compact('breadcrumbs'));
    }
    public function store(Request $request)
    {
        // $this->authorize('create', Admin::class);
        $validated = $this->validate($request, [
            'gst' => 'required',
            'status' => 'required',
        ]);
        $gst = Gst::firstOrCreate();
        $gst->gst = $validated['gst'];
        $gst->status = $validated['status'];
        $gst->save();
        if ($gst) {
            activity('admin')->performedOn($gst)->causedBy($gst)->withProperties(['data' => $request])->log('Created #' . $gst->size . '.');
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
}
