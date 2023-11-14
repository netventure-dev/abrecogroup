<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdditionalPage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\DataTables\Admin\AdditionalPageDataTable;

class AdditionalPagesController extends Controller
{
    public function index(AdditionalPageDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Additional Pages')), null],
        ];
        return $dataTable->render('admin.pages.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Additional Pages', route('admin.additional-pages.index')],
            ['Create', route('admin.additional-pages.create')],
        ];
        return view('admin.pages.create', compact('breadcrumbs'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:additional_pages,title|max:255',
            'content' => 'nullable',
            'content2' => 'nullable',
            'sub_title' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'alt_text' => 'nullable',
            'b_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'logo_alt_text' => 'nullable',
            'link' => 'nullable',
            'button_title' => 'nullable',
            'status' => 'required',
            'order' => 'nullable',
        ]);
        $page = new AdditionalPage();
        $page->uuid = (string) Str::uuid();
        $page->slug = SlugService::createSlug(AdditionalPage::class, 'slug', $validated['title'], ['unique' => false]);
        $page->title = $validated['title'];
        $page->content = $validated['content'];
        $page->content2 = $validated['content2'];
        $page->logo_alt_text = $validated['logo_alt_text'];

        $page->alt_text = $validated['alt_text'];

        $page->order = $validated['order'];
        $page->status = $validated['status'];  
        $page->subtitle = $validated['sub_title'];
        $page->link = $validated['link'];
        $page->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $page->image1 = $path;
        }
        if ($request->hasFile('b_image')) {
            $path =  $request->file('b_image')->storeAs('media/image',  $validated['b_image']->getClientOriginalName(), 'public');
            $page->background_image = $path;
        }
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/image',  $validated['logo']->getClientOriginalName(), 'public');
            $page->image2 = $path;
        }
        $res = $page->save();
        if ($res) {
            notify()->success(__('Created Successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        $page= AdditionalPage::where('uuid',$id)->first();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Additional Pages', route('admin.additional-pages.index')],
            [$page->title, null],
        ];
        return view('admin.pages.edit', compact('breadcrumbs','page'));
    }
    public function update(Request $request,$id)
    {
        
        $page = AdditionalPage::where('uuid',$id)->first();

        $validated = $request->validate([
            'title' => 'required|unique:additional_pages,title|max:255,'.$page->id,
            'content' => 'nullable',
            'content2' => 'nullable',
            'sub_title' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'b_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'link' => 'nullable',
            'button_title' => 'nullable',
            'status' => 'required',
            'order' => 'nullable',
            'alt_text' => 'nullable',
            'logo_alt_text' => 'nullable',


        ]);
        $page->slug = SlugService::createSlug(AdditionalPage::class, 'slug', $validated['title'], ['unique' => false]);
        $page->title = $validated['title'];
        $page->content = $validated['content'];
        $page->content2 = $validated['content2'];
        $page->order = $validated['order'];
        $page->status = $validated['status'];  
        $page->subtitle = $validated['sub_title'];
        $page->logo_alt_text = $validated['logo_alt_text'];
        $page->alt_text = $validated['alt_text'];
        $page->link = $validated['link'];
        $page->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $page->image1 = $path;
        }
        if ($request->hasFile('b_image')) {
            $path =  $request->file('b_image')->storeAs('media/image',  $validated['b_image']->getClientOriginalName(), 'public');
            $page->background_image = $path;
        }
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/image',  $validated['logo']->getClientOriginalName(), 'public');
            $page->image2 = $path;
        }
        $res = $page->save();
        if ($res) {
            notify()->success(__('Updated Successfully'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = AdditionalPage::where('uuid',$id)->delete();
        // $content=SubService::where('section_id',$id)->first();
       
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
