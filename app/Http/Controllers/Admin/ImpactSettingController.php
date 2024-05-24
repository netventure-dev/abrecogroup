<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImpactSetting;
use App\Models\ImpactList;
use Illuminate\Support\Str;


class ImpactSettingController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['About Us', route('admin.about-us.settings.create')],
        ];
        $data = ImpactSetting::first();
        $news = ImpactList::paginate(10);
        return view('admin.about-us.impact.index', compact('breadcrumbs','data','news'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'nullable',
        ]);
        $data = ImpactSetting::firstOrCreate();
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
    public function liststore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'status' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
        ]);
        
        $data = new ImpactList();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->content = $validated['content'];
        $data->status= $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/aboutus/image',$validated['image']->getClientOriginalName(), 'public');
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
    public function listedit($id)
    {
        $data = ImpactList::where('uuid',$id)->firstOrFail();
    
        $breadcrumbs = [
            [__('Dashboard'), route('admin.home')],
            ['Our Impact', route('admin.impact.settings.index')],
            ['Edit', Null],
        ];
    
        return view('admin.about-us.impact.list.edit', compact('breadcrumbs', 'data'));
    }

    public function listupdate(Request $request,$id)
    {
        $data= ImpactList::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'status' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
        ]);

        $data->title = $validated['title'];
        $data->content = $validated['content'];
        $data->status= $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/aboutus/image',$validated['image']->getClientOriginalName(), 'public');
            $data->image = $path;
        }
        $res = $data->save();
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }
        return redirect()->back();
    }
    public function image_delete(Request $request)
    {

        $section = ImpactList::where('uuid',$request->uuid)->first();
        $section->image = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
     public function listdestroy(Request $request, $id)
    {
          
        $impact = ImpactList::where('uuid', $id)->first();
        $res = $impact->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    

        
    
   
}
