<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SchemaDataTable;
use App\Http\Controllers\Controller;
use App\Models\SchemaMarkup;
use App\Models\InnerServiceExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SchemaController extends Controller
{
    public function index()
   {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Schema')),  route('admin.schema.index')],
            ['Schema', null],
        ];
        $schema = SchemaMarkup::paginate(10);
        return view('admin.schema.index',compact('breadcrumbs','schema'));
   }

   public function store(Request $request)
   {
        $validated = $request->validate([      
            'slug' => 'required',
            'title' => 'nullable',
            'description' => 'nullable',
        ]);
        $schema = new SchemaMarkup();
        $schema->uuid = (string) Str::uuid();
        $schema->route_name = $validated['slug'];
        $schema->title =  $validated['title'];
        $schema->description =  $validated['description'];
        $res = $schema->save();
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
        $schema = SchemaMarkup::where('uuid',$id)->first();
        $route = @$request->route;
        if($route){            
        $schema->route_name = $request->route;
        }
        $title = @$request->title;
        if($title){            
            $schema->title = $request->title;
        }
        $description = @$request->description;
        if($description){            
            $schema->description = $request->description;
        }
        $res = $schema->update();


        if($res){
            return response()->json(['success' => true,'message' => 'Updated Successfully']);
        }
    }
   }
}
