<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Benifit;
use App\Models\BenifitList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class BenifitsController extends Controller
{
    public function create()
    {
        $news = BenifitList::paginate(10);

        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['benifit', route('admin.news.index')],
            ['Create', route('admin.blog-list.create')],
        ];
        // $data = AbrecoWorkingPrinclple::first();
        // $news = AbrecoWorkingPrinclpleList::paginate(10);


        return view('admin.life-abreco.benifits.create', compact('breadcrumbs', 'news'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',


        ]);
        $data = Benifit::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->content = $validated['content'];


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
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
        ]);
        $data =  new BenifitList();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->content = $validated['content'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/testimonials/image/', $validated['image']->getClientOriginalName(), 'public');
            $data->image = $path;
        }
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

        $milestone = BenifitList::where('id', $uuid)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Benifit List')), route('admin.benifits.create')],
            [(__('Milestone')), null],
        ];
        // $services=Service::where('status',1)->get();
        $data = BenifitList::get();
        return view('admin.life-abreco.benifits.edit', compact('milestone', 'breadcrumbs', 'data'));
    }

    public function update(Request $request, $uuid)
    {
        $milestone = BenifitList::where('uuid', $uuid)->first();

        $validatedData = $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',

        ]);
        $milestone->title = $validatedData['title'];
        $milestone->content = $validatedData['content'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/testimonials/image/', $validatedData['image']->getClientOriginalName(), 'public');
            $milestone->image = $path;
        }
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
        $news = BenifitList::where('id', $id)->first();
        $res = $news->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
