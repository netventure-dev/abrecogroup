<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\HomeSliderDatatable;
use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;
use Illuminate\Support\Str;
use JoeDixon\Translation\Language;
use Illuminate\Http\Request;

class ChooseListController extends Controller
{
    // public function index(HomeSliderDatatable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.why-choose-us.list')],
            [(__('Slider')), null],
        ];
        return $dataTable->render('admin.why-choose-us.list.index', ['breadcrumbs' => $breadcrumbs]);
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
            ['Dashboard', route('admin.why-choose-us.list')],
            ['Slider', route('admin.why-choose-us.list.index')],
            ['Create', route('admin.why-choose-us.list.create')],
        ];
        return view('admin.why-choose-us.list.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required|unique:home_sliders,title',
            'content' => 'required',
            'link' => 'nullable',
            'image' => 'required|mimes:jpg,jpeg,png,webp | max:2000',
            'status' => 'required',
        ]);
        $slider = new WhyChooseUs;
        $slider->uuid = (string) Str::uuid();
        $slider->title = $validated['title'];
        $slider->link = $validated['link'];
        $slider->description = $validated['content'];
        $slider->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image/', $slider->title . $validated['image']->getClientOriginalName(), 'public');
            $slider->image = $path;
        }
        $res = $slider->save();
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
        $slider= WhyChooseUs::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Slider')),  route('admin.why-choose-us.list.index')],
            [$slider->title, null],
    ];
        return view('admin.why-choose-us.list.edit', compact('breadcrumbs','slider'));
    }
    public function update(Request $request,$id)
    {
        // $this->authorize('create', Gender::class);
        $slider= WhyChooseUs::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:home_sliders,title,'.$slider->id,
            'content' => 'required',
            'link' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp | max:2000',
            'status' => 'required',
        ]);
        $slider->title = $validated['title'];
        $slider->description = $validated['content'];
        $slider->status = $validated['status'];
        $slider->link = $validated['link'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image/', $slider->title . $validated['image']->getClientOriginalName(), 'public');
            $slider->image = $path;
        }
        $res = $slider->save();
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
        $res = WhyChooseUs::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
