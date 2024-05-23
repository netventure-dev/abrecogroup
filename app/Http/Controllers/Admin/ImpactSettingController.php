<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImpactSetting;
use App\Models\ImpactImage;
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
        $life = ImpactImage::get();
        return view('admin.about-us.impact.index', compact('breadcrumbs','data','life'));
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
    public function image(Request $request)
    {
        // $data = ImpactSetting::first();
        $image =$request->file('file');
        $imageUpload = new ImpactImage();
        //  $uuid = Uuid::generate()->string;
            // $imageUpload->impact_id=$data->uuid;
        // $imageUpload->id = $uuid;
        if($image){
            
                // $avatarName =  'upload/gallery/' . 'image_' .$image->getClientOriginalName();
                // $image->move(public_path('upload/gallery'),$avatarName);
                
                $path = $request->file('file')->storeAs(
                    'upload/logos',
                    time() . '_' . $image->getClientOriginalName(),
                    'public'
                );
                // $page->image = $path;
                
                // $vehicle->image = $avatarName;
                $imageUpload->image = $path;
                // $imageUpload->work_id = '';
                $imageUpload->save();
            // return response()->json(['success'=>$avatarName]);
            return redirect()->back()->with('success', 'Successfully added .');
        }
    }
    public function order(Request $request)
    {
       
        $image = ImpactImage::where('id',$request->id)->first();
        $image->order = $request->data;
        $res = $image->update();
        // dd($vehicle);
        if($res){
            $data['message'] = 'Order updated Successfully';
            $data['status'] = '1';
            return response()->json($data);
        }
    }
    public function destroy($id)
    {

        
        $logo = ImpactImage::where('id',$id)->first();

        // $this->authorize('delete', $data);
        $res = $logo->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();

    }

    

        
    
   
}
