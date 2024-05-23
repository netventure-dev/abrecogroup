<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LifeAtAbrecoValue;
use App\Models\LifeAtAbrecoValueList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class LifeAtAbrecoValueController extends Controller
{
    // public function index()
    // {
    //     return view('admin.life-abreco.value.create',['news'=>$news]);
    // }
    public function create()
    {


        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['News', route('admin.news.index')],
            ['Create', route('admin.blog-list.create')],
        ];
        $data = LifeAtAbrecoValue::first();
        $news = LifeAtAbrecoValueList::paginate(10);


        return view('admin.life-abreco.value.create', compact('breadcrumbs', 'data', 'news'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',


        ]);
        $data = LifeAtAbrecoValue::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
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
        ]);
        $data =  new LifeAtAbrecoValueList();
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

    public function edit($uuid)

    {

        $milestone = LifeAtAbrecoValueList::where('id', $uuid)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Milestone List')), route('admin.milestone.list.index')],
            [(__('Milestone')), null],
        ];
        // $services=Service::where('status',1)->get();
        $data = LifeAtAbrecoValueList::get();
        return view('admin.life-abreco.value.edit', compact('milestone', 'breadcrumbs', 'data'));
    }

    public function update(Request $request, $uuid)
    {
        $milestone = LifeAtAbrecoValueList::where('uuid', $uuid)->first();

        $validatedData = $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',
        ]);
        $milestone->title = $validatedData['title'];
        $milestone->content = $validatedData['content'];
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
        $news = LifeAtAbrecoValueList::where('id', $id)->first();
        $res = $news->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
