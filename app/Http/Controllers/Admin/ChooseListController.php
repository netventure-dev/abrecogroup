<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WhyChooseUsListDataTable;
use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;
use Illuminate\Support\Str;
use JoeDixon\Translation\Language;
use Illuminate\Http\Request;

class ChooseListController extends Controller
{
    public function index(WhyChooseUsListDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
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
            ['Dashboard', route('admin.home')],
            ['Why Choose Us List', route('admin.why-choose-us.list.index')],
            ['Create', route('admin.why-choose-us.list.create')],
        ];
        return view('admin.why-choose-us.list.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required|unique:why_choose_us,title',
            'content' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp | max:2000',
            'status' => 'required',
        ]);
        $data = new WhyChooseUs;
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->description = $validated['content'];
        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/why_choose/image/', $data->title . $validated['image']->getClientOriginalName(), 'public');
            $data->image = $path;
        }
        $res = $data->save();
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
        $data= WhyChooseUs::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:why_choose_us,title,'.$data->id,
            'content' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp | max:2000',
            'status' => 'required',
        ]);
        $data->title = $validated['title'];
        $data->description = $validated['content'];
        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/why_choose/image/', $data->title . $validated['image']->getClientOriginalName(), 'public');
            $data->image = $path;
        }
        $res = $data->save();
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
