<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TestimonialsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use JoeDixon\Translation\Language;
use Illuminate\Http\Request;


class TestimonialsController extends Controller
{
    public function index(TestimonialsDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Slider')), null],
        ];
        return $dataTable->render('admin.testimonials.index', ['breadcrumbs' => $breadcrumbs]);
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
            ['Testimonials', route('admin.testimonials.index')],
            ['Create', route('admin.testimonials.create')],
        ];
        return view('admin.testimonials.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required|unique:testimonials,title',
            'content' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp | max:2000',
            'status' => 'required',
        ]);
        $data = new Testimonial;
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->description = $validated['content'];
        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/testimonials/image/',$validated['image']->getClientOriginalName(), 'public');
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
        $data= Testimonial::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Testimonials')),  route('admin.testimonials.index')],
            [$data->title, null],
    ];
        return view('admin.testimonials.edit', compact('breadcrumbs','data'));
    }
    public function update(Request $request,$id)
    {
        // $this->authorize('create', Gender::class);
        $data= Testimonial::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:testimonials,title,'.$data->id,
            'content' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp | max:2000',
            'status' => 'required',
        ]);
        $data->title = $validated['title'];
        $data->description = $validated['content'];
        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/testimonials/image/',$validated['image']->getClientOriginalName(), 'public');
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
        $res = Testimonial::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
