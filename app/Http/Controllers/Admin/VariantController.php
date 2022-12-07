<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\Admin\VariantDataTable;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Variant;
use App\Models\Brand;
use App\Models\SubModel;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(VariantDataTable $dataTable)
    {
        // $this->authorize('viewAny', Admin::class);
        $user = auth()->guard('admin')->user();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Variants', route('admin.variants.index')],
        ];
        return $dataTable->render('admin.variants.index', ['user' => $user, 'breadcrumbs' =>$breadcrumbs]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        // $this->authorize('create', Admin::class);
        $brands= Brand::where('status',1)->get();
        $fuels= FuelType::where('status',1)->get();
        $sub_models= SubModel::where('status',1)->get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Variants', route('admin.variants.index')],
            ['Create', route('admin.variants.create')],
        ];
        return view('admin.variants.create', compact('breadcrumbs','sub_models','brands','fuels'));
    }


    public function store(Request $request)
    {
        // $this->authorize('create', Admin::class);
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'brand' => 'required',
            'sub_model' => 'required',
            'fuel_type' => 'required',
            'on_road_price' => 'required',
            'offer' => 'nullable',
            'status' => 'required',
            
        ]);
        $data = new Variant();
        $data->name = $validated['name'];
        $data->brand_id = $validated['brand'];
        $data->sub_model_id = $validated['sub_model'];
        $data->fuel_id = $validated['fuel_type'];
        $data->on_road_price = $validated['on_road_price']; 
        $data->offer = $validated['offer'];
        $data->status = $validated['status'];
        $data->save();
        if ($data) {
            activity('data')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Variant #' . $data->name . '.');
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

    public function update(Request $request,$id)
    {
        // $this->authorize('create', Admin::class);
        $data =  Variant::whereid($id)->firstorFail();
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'brand' => 'required',
            'sub_model' => 'required',
            'fuel' => 'required',
            'on_road_price' => 'required',
            'offer' => 'nullable',
            'status' => 'required',
            
        ]);
        $data->name = $validated['name'];
        $data->brand_id = $validated['brand'];
        $data->sub_model_id = $validated['sub_model'];
        $data->fuel_id = $validated['fuel'];
        $data->on_road_price = $validated['on_road_price']; 
        $data->offer = $validated['offer'];
        $data->status = $validated['status'];
        $data->save();
        if ($data) {
            activity('data')->performedOn($data)->causedBy($data)->withProperties(['data' => $request])->log('Created Variant #' . $data->name . '.');
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
        $variant = Variant::whereid($id)->firstorFail();
        $brands= Brand::where('status',1)->get();
        $fuels= FuelType::where('status',1)->get();
        $sub_models= SubModel::where('status',1)->get();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Variants', route('admin.variants.index')],
            [$brand->name, null],
        ];
        return view('admin.variants.edit', compact('variant','sub_models','brands','fuels'));
    }
}
