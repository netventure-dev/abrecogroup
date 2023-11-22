<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BlogDataTable;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Models\Bloglist;
use Illuminate\Support\Str;

class BlogListController extends Controller
{

    public function index(BlogDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('blog')), null],
        ];
        return $dataTable->render('admin.bloglist.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Blog', route('admin.blog-list.index')],
            ['Create', route('admin.blog-list.create')],
        ];
        return view('admin.bloglist.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required|unique:blogs,title',
            'canonical_tag' => 'nullable',
            'author' => 'nullable',
            'schedule_date' =>  'nullable|date',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
        ]);
        $blogs = new Bloglist();
        $blogs->uuid = (string) Str::uuid();date("Y-m-d", strtotime($request->date));
        $blogs->title = $validated['title'];
        $blogs->canonical_tag = $validated['canonical_tag'];
        $blogs->description = $validated['description'];
        $blogs->author = $validated['author'];
        $blogs->blog_date = $validated['schedule_date'];
        $blogs->status = $validated['status'];
        $blogs->slug = SlugService::createSlug(Bloglist::class, 'slug', $validated['title'], ['unique' => false]);
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/blogs/image', $validated['image']->getClientOriginalName(), 'public');
            $blogs->image = $path;
        }
        $blogs->seo_title = $validated['seo_title'];
        $blogs->seo_keywords = $validated['seo_keyword'];
        $blogs->seo_description = $validated['seo_description'];
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
        $blog = Bloglist::where('uuid', $id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Blog')),  route('admin.blog-list.index')],
            [$blog->title, null],
        ];
        return view('admin.bloglist.edit', compact('breadcrumbs', 'blog'));
    }

    public function update(Request $request, $id)
    {
        // $this->authorize('create', Gender::class);
        $blog = Bloglist::where('uuid', $id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:blogs,title,' . $blog->id,
            'canonical_tag' => 'nullable',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
            'author' => 'nullable',
            'schedule_date' =>  'nullable|date',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
        ]);
        $blog->title = $validated['title'];
        $blog->canonical_tag = $validated['canonical_tag'];
        $blog->description = $validated['description'];
        $blog->status = $validated['status'];
        $blog->slug = SlugService::createSlug(Bloglist::class, 'slug', $validated['title'], ['unique' => false]);
        $blog->author = $validated['author'];
        $blog->blog_date = $validated['schedule_date'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image', $validated['image']->getClientOriginalName(), 'public');
            $blog->image = $path;
        }
        $blog->seo_title = $validated['seo_title'];
        $blog->seo_keywords = $validated['seo_keyword'];
        $blog->seo_description = $validated['seo_description'];
        $res = $blog->save();
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
        $res = Bloglist::where('uuid', $id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

    public function image_delete(Request $request)
    {

        $data = Bloglist::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }
}
