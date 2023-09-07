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
             // [(__('SEO')),  route('admin.seo.index')],
             // ['SEO', null],
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

        ]);

        $content =  Privacy::firstOrCreate();
        $content->uuid = (string) Str::uuid();
        $content->title =  $validated['title'];
        $content->content =  $validated['content'];


        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/image',  $validated['image']->getClientOriginalName(), 'public');
            $content->image = $path;
        }
        $res = $content->save();

        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
     }
}
