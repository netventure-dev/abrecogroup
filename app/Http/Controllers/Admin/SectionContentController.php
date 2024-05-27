<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\SectionContent;
use Illuminate\Http\Request;
use DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

class SectionContentController extends Controller
{
    public function index( $id)
    {
        $section= Section::where('uuid',$id)->first();
        $contents = SectionContent::where('section_id',$section->uuid)->get();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Sections')),  route('admin.sections.index')],
            [$section->title, null],
        ];
// dd( $sections );

        return view('admin.sections.content.index',compact('section','breadcrumbs','contents'));
    }

    public function create($id)
    {
        $section= Section::where('uuid',$id)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Sections')), route('admin.sections.index')],
            [$section->title, route('admin.sections.content.index',$section->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.sections.content.create',compact('section','breadcrumbs'));
    }

    public function store(Request $request, $id)
    {
        $section= Section::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'content' => 'required',
            'icon' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'alt_text' => 'nullable',

            'order' => 'required|numeric',
            'icon_content' => 'nullable',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]); 

        $content = new SectionContent();
        $content->uuid = (string) Str::uuid();
        $content->section_id = $section->uuid;
        $content->title =  $validated['title'];
        $content->alt_text =  $validated['alt_text'];

        $content->icon_content =  $validated['content'];
        $content->order =  $validated['order'];
        $content->button_title =  $validated['button_title'];
        $content->button_link =  $validated['button_link'];
        if ($request->hasFile('icon')) {
            $path =  $request->file('icon')->storeAs('media/image',  $validated['icon']->getClientOriginalName(), 'public');
            $content->icon = $path;
        }
        $res = $content->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();


    }

    public function edit($id,$uuid)
    {
        $section= Section::where('uuid',$id)->first();
        $content = SectionContent::where('uuid',$uuid)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Section')), route('admin.sections.index')],
            [$section->title, route('admin.sections.content.index',$section->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.sections.content.edit',compact('section','breadcrumbs','content'));
    }

    
    public function update(Request $request, $id,$uuid)
    {
        $section= Section::where('uuid',$id)->first();
        $content = SectionContent::where('uuid',$uuid)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'content' => 'required',
            'icon' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'alt_text' => 'nullable',

            'order' => 'required|numeric',
            'icon_content' => 'nullable',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
        ]); 

        // $content = new ServiceContent(); 
        // $content->service_id = $services->uuid;
        $content->section_id = $section->uuid;
        $content->title =  $validated['title'];
        $content->alt_text =  $validated['alt_text'];

        $content->icon_content =  $validated['content'];
        $content->order =  $validated['order'];
        $content->button_title =  $validated['button_title'];
        $content->button_link =  $validated['button_link'];
        if ($request->hasFile('icon')) {
            $path =  $request->file('icon')->storeAs('media/image',  $validated['icon']->getClientOriginalName(), 'public');
            $content->icon = $path;
        }
        $res = $content->save();

       
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy($id,$uuid)
    {
        // $this->authorize('delete', $menu);
        // $res = Service::where('uuid',$id);
        $res = SectionContent::where('uuid',$uuid)->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    public function image_delete(Request $request)
    {
        
        $section = SectionContent::where('uuid',$request->uuid)->first();
        $section->icon = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
}
