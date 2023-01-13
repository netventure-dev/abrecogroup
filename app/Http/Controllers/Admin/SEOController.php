<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gtm;
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
        $gtm = Gtm::first();
        return view('admin.seo.index',compact('breadcrumbs','seo','gtm'));
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
   public function update(Request $request, $id)
   {
    
    if($request->ajax()){
        $seo = Seo::where('uuid',$id)->first();
        $route = @$request->route;
        if($route){            
        $seo->route_name = $request->route;
        }
        $title = @$request->title;
        if($title){            
            $seo->seo_title = $request->title;
        }
        $description = @$request->description;
        if($description){            
            $seo->seo_description = $request->description;
        }
        $keywords = @$request->keywords;
        if($keywords){            
            $seo->seo_keywords = $request->keywords;
        }
        $res = $seo->update();


        if($res){
            return response()->json(['success' => true,'message' => 'Updated Successfully']);
        }
    }
   }

   public function gtm(Request $request)
   {
    
    if($request->ajax()){
        $data = Gtm::firstOrCreate();
        $head = @$request->head;        
        if($head){            
        $data->head = $request->head;
        }
        $body = @$request->body;
        if($body){            
        $data->body = $request->body;
        }
        $res = $data->save();

        if($res){
            return response()->json(['success' => true,'message' => 'Updated Successfully']);
        }
    }
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
