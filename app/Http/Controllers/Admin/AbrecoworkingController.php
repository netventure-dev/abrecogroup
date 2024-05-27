<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbrecoWorkingPrinclple;
use App\Models\AbrecoWorkingPrinclpleList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AbrecoworkingController extends Controller
{
    public function create()
    {



        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['News', route('admin.news.index')],
            ['Create', route('admin.blog-list.create')],
        ];
        $data = AbrecoWorkingPrinclple::first();
        $news = AbrecoWorkingPrinclpleList::paginate(10);


        return view('admin.life-abreco.working-principle.create', compact('breadcrumbs', 'news', 'data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',
            
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',


        ]);
        $data = AbrecoWorkingPrinclple::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->content = $validated['content'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/testimonials/image/', $validated['image']->getClientOriginalName(), 'public');
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

    public function list_store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',
            'status' => 'required',
        ]);
        $data =  new AbrecoWorkingPrinclpleList();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->content = $validated['content'];
        $data->status = $validated['status'];
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

    public function edit($uuid)
    {

        $milestone = AbrecoWorkingPrinclpleList::where('id', $uuid)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Working List')), route('admin.working.create')],
            [(__('Milestone')), null],
        ];
        // $services=Service::where('status',1)->get();
        $data = AbrecoWorkingPrinclpleList::get();
        return view('admin.life-abreco.working-principle.edit', compact('milestone', 'breadcrumbs', 'data'));
    }

    public function update(Request $request, $uuid)
    {
        $milestone = AbrecoWorkingPrinclpleList::where('uuid', $uuid)->first();

        $validatedData = $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',
            'status' => 'required',

        ]);
        $milestone->title = $validatedData['title'];
        $milestone->content = $validatedData['content'];
        $milestone->status = $validatedData['status'];
        $res = $milestone->save();

        if ($res) {
            notify()->success(__('Updated  successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
          
        // $delEvents = NewsEventsCategory::where('category_id', $id)->delete();
        $news = AbrecoWorkingPrinclpleList::where('id', $id)->first();
        $res = $news->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
