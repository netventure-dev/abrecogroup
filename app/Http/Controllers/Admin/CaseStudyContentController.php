<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\CaseStudyContent;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class CaseStudyContentController extends Controller
{
    public function index($id)
    {
        $casestudy = CaseStudy::where('uuid', $id)->first();
        $contents = CaseStudyContent::where('case_id', $casestudy->uuid)->get();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Case Study')),  route('admin.casestudies.index')],
            [$casestudy->title, null],
        ];
        // dd( $services );

        return view('admin.casestudy.content.index', compact('casestudy', 'breadcrumbs', 'contents'));
    }

    public function create($id)
    {
        $casestudy = CaseStudy::where('uuid', $id)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Case Study')), route('admin.casestudies.index')],
            [$casestudy->title, route('admin.casestudies.contents.index', $casestudy->uuid)],
            [(__('Content')), null],
        ];
        return view('admin.casestudy.content.create', compact('casestudy', 'breadcrumbs'));
    }
    public function store(Request $request, $id)
    {
        $casestudy = CaseStudy::where('uuid', $id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:case_study_contents,title',
            'content' => 'nullable',
            'sub_title' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000', 
            'mobile_image'=>'nullable|mimes:jpg,jpeg,png,webp|max:2000', 
            'link' => 'nullable',
            'section' => 'required',
            'button_title' => 'nullable',
            'status' => 'required',
            'order' => [
                'required',
                Rule::unique('case_study_contents', 'order')->where(function ($query) use ($id) {
                    return $query->where('case_id', $id);
                })->ignore($casestudy->id),
            ],
        ]);
        $case = new CaseStudyContent();
        $case->uuid = (string) Str::uuid();
        $case->title = $validated['title'];
        $case->case_id = $casestudy->uuid;
        $case->content = $validated['content'];
        $case->order = $validated['order'];
        $case->section =  $validated['section'];
        $case->status = $validated['status'];
        $case->subtitle = $validated['sub_title'];
        $case->link = $validated['link'];
        $case->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $case->image1 = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/mobile_image',  $validated['mobile_image']->getClientOriginalName(), 'public');
            $case->mobile_image = $path;
        }
        $res = $case->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function update(Request $request, $id, $uuid)
    {
        $casestudy = CaseStudy::where('uuid', $id)->first();
        $content = CaseStudyContent::where('uuid', $uuid)->first();
        $validated = $request->validate(['title' => 'required',
            'content' => 'nullable',
            'sub_title' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_image'=>'nullable|mimes:jpg,jpeg,png,webp|max:2000', 
            'link' => 'nullable',
            'order' => [
                'required',
                Rule::unique('case_study_contents', 'order')
                    ->where(function ($query) use ($id) {
                        return $query->where('case_id', $id);
                    })
                    ->ignore($content->uuid, 'uuid'), // Replace $serviceContentId with the actual ID of the record being updated
            ],
            'button_title' => 'nullable',
            'status' => 'required',
            'section' => 'required',
        ]);

        $content->title = $validated['title'];
        $content->case_id = $casestudy->uuid;
        $content->content = $validated['content'];
        $content->order = $validated['order'];
        $content->status = $validated['status'];
        $content->subtitle = $validated['sub_title'];
        $content->link = $validated['link'];
        $content->section =  $validated['section'];
        $content->button_title = $validated['button_title'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $content->image1 = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/mobile_image',  $validated['mobile_image']->getClientOriginalName(), 'public');
            $content->mobile_image = $path;
        }
        $res = $content->save();
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id, $uuid)
    {
        $casestudy = CaseStudy::where('uuid', $id)->first();
        $content = CaseStudyContent::where('uuid', $uuid)->first();

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Case Study')), route('admin.casestudies.index')],
            [$casestudy->title, route('admin.casestudies.contents.index', $casestudy->uuid)],
            [$content->title, null],
        ];
        return view('admin.casestudy.content.edit', compact('casestudy', 'breadcrumbs', 'content'));
    }
    public function destroy($id,$uuid)
    {
        // $this->authorize('delete', $menu);
        $res = CaseStudyContent::where('uuid', $uuid)->delete();
        // $content=SubService::where('section_id',$id)->first();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
      // image delete
      public function image_delete(Request $request)
      {
          $section = CaseStudyContent::where('uuid',$request->uuid)->first();
          $section->image1 = "";
          $section->save();
          return response()->json(['status' => "success"]);
      }
      public function image_delete_one(Request $request)
      {
          $section = CaseStudyContent::where('uuid',$request->uuid)->first();
          $section->mobile_image = "";
          $section->save();
          return response()->json(['status' => "success"]);
      }
}
