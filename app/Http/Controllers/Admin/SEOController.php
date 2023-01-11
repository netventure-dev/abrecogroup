<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SEOController extends Controller
{
   public function index()
   {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('SEO')),  route('admin.seo.index')],
            ['SEO', null],
        ];
        $seo = Seo::paginate(10);
        return view('admin.seo.index',compact('breadcrumbs','seo'));
   }

   public function store(Request $request)
   {
        $validated = $request->validate([      
            'slug' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $seo = new Seo();
        $seo->uuid = (string) Str::uuid();
        $seo->route_name = $validated['slug'];
        $seo->seo_title =  $validated['seo_title'];
        $seo->seo_description =  $validated['seo_description'];
        $seo->seo_keywords =  $validated['seo_keywords'];
        $res = $seo->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
   }

   public function destroy($id)
   {
        
        $seo = Seo::where('uuid',$id)->delete();
      
        if ($seo) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to delete. Please try again'));
        }
        return redirect()->back();
   }

}
