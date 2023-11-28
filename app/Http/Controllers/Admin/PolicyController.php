<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Privacy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PolicyController extends Controller
{
    public function index()
    {
         $breadcrumbs = [
             [(__('Dashboard')), route('admin.home')],
            //  [(__('SEO')),  route('admin.seo.index')],
             ['Policy', null],
         ];
         $policy=Privacy::first();
         return view('admin.policy.policy',compact('breadcrumbs','policy'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'nullable',
            'content' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',

        ]);

        $content =  Privacy::firstOrCreate();
        $content->uuid = (string) Str::uuid();
        $content->title =  $validated['title'];
        $content->content =  $validated['content'];


        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $content->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/mobile_image',  $validated['mobile_image']->getClientOriginalName(), 'public');
            $content->mobile_image = $path;
        }
        $res = $content->save();

        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
     }
    public function image_delete(Request $request)
    {

        $data = Privacy::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->image	 = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }
    public function image_delete_one(Request $request)
    {

        $data = Privacy::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->mobile_image	 = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }
}
