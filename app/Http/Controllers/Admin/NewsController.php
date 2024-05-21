<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\NewsDatatable;
use App\Http\Controllers\Controller;
use App\Models\News;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Http\Request;
use Illuminate\Support\Str;



class NewsController extends Controller
{
    public function index(NewsDatatable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('News')), null],
        ];
        return $dataTable->render('admin.news.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['News', route('admin.news.index')],
            ['Create', route('admin.blog-list.create')],
        ];
        return view('admin.news.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
           
        ]);
        $blogs = new News();
        $blogs->uuid = (string) Str::uuid();date("Y-m-d", strtotime($request->date));
        $blogs->title = $validated['title'];
        $blogs->description = $validated['description'];
        $blogs->status = $validated['status'];
        $blogs->slug = SlugService::createSlug(News::class, 'slug', $validated['title'], ['unique' => false]);
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/blogs/image', $validated['image']->getClientOriginalName(), 'public');
            $blogs->image = $path;
        }
        $res = $blogs->save();
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
        $blog = News::where('uuid', $id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('News')),  route('admin.news.index')],
            [$blog->title, null],
        ];
        return view('admin.news.edit', compact('breadcrumbs', 'blog'));
    }

    public function update(Request $request, $id)
    {
        // $this->authorize('create', Gender::class);
        $blog = News::where('uuid', $id)->first();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
           
        ]); 
        $blog->title = $validated['title'];
        $blog->description = $validated['description'];
        $blog->status = $validated['status'];
        $blog->slug = SlugService::createSlug(News::class, 'slug', $validated['title'], ['unique' => false]);
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image', $validated['image']->getClientOriginalName(), 'public');
            $blog->image = $path;
        }
        $res = $blog->save();
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

    public function image_delete(Request $request)
    {

        $data = News::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }

    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = News::where('uuid', $id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
