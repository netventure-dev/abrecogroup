<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SectionDataTable;
use App\Models\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SectionController extends Controller
{
    public function index(SectionDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Sections')), null],
        ];
        return $dataTable->render('admin.sections.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Sections', route('admin.sections.index')],
            ['Create', route('admin.sections.create')],
        ];
        return view('admin.sections.create', compact('breadcrumbs'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:sections,title',
            'content' => 'nullable',
            'content2' => 'nullable',
            'sub_title' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'alt_text' => 'nullable',
            'alt_background' =>'nullable',
            'b_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'link' => 'nullable',
            'button_title' => 'nullable',
            'status' => 'required',
            'order' => 'required|unique:sections,order',
            
        ]);
        $section = new Section();
        $section->uuid = (string) Str::uuid();
        $section->slug = SlugService::createSlug(Section::class, 'slug', $validated['title'], ['unique' => false]);
        $section->title = $validated['title'];
        $section->content = $validated['content'];
        $section->alt_text = $validated['alt_text'];
        $section->alt_background = $validated['alt_background'];

        $section->content2 = $validated['content2'];
        $section->order = $validated['order'];
        $section->status = $validated['status'];  
        $section->subtitle = $validated['sub_title'];
        $section->link = $validated['link'];
        $section->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $section->image1 = $path;
        }
        if ($request->hasFile('b_image')) {
            $path =  $request->file('b_image')->storeAs('media/image',  $validated['b_image']->getClientOriginalName(), 'public');
            $section->background_image = $path;
        }
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/image',  $validated['logo']->getClientOriginalName(), 'public');
            $section->image2 = $path;
        }
        $res = $section->save();
        if ($res) {
            notify()->success(__('Created Successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        $section= Section::where('uuid',$id)->first();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Sections', route('admin.sections.index')],
            [$section->title, null],
        ];
        return view('admin.sections.edit', compact('breadcrumbs','section'));
    }
    public function update(Request $request,$id)
    {
        
        $section = Section::where('uuid',$id)->first();

        $validated = $request->validate([
            'title' => 'required|unique:sections,title,'.$section->id,
            'content' => 'nullable',
            'content2' => 'nullable',
            'sub_title' => 'nullable',
            'alt_text' => 'nullable',
            'alt_background' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'background_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'link' => 'nullable',
            'button_title' => 'nullable',
            'status' => 'required','order' => 'required|unique:sections,order',
        ]);
        $section->slug = SlugService::createSlug(Section::class, 'slug', $validated['title'], ['unique' => false]);
        $section->title = $validated['title'];
        $section->content = $validated['content'];
        $section->content2 = $validated['content2'];
        $section->order = $validated['order'];
        $section->status = $validated['status'];
        $section->alt_text = $validated['alt_text'];
        $section->alt_background = $validated['alt_background'];
        $section->subtitle = $validated['sub_title'];
        $section->link = $validated['link'];
        $section->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $section->image1 = $path;
        }
        if ($request->hasFile('background_image')) {
            $path =  $request->file('background_image')->storeAs('media/image',  $validated['background_image']->getClientOriginalName(), 'public');
            $section->background_image = $path;
        }
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/image',  $validated['logo']->getClientOriginalName(), 'public');
            $section->image2 = $path;
        }
        $res = $section->save();
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
        $res = Section::where('uuid',$id)->delete();
        // $content=SubService::where('section_id',$id)->first();
       
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
