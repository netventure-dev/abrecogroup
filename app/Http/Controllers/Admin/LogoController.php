<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function create()  {
        $user = auth()->guard('admin')->user();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            // ['Client', route('admin.logos.index')],
        ];
        $life = Logo::get();

    //    dd($logos);
        return view('admin.logo.create',compact('user','breadcrumbs','life'));
    }

    public function store(Request $request)
    {
        $image =$request->file('file');
        $imageUpload = new Logo();
        // $uuid = Uuid::generate()->string;
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

    public function destroy($id)
    {

        
        $logo = Logo::where('id',$id)->first();

        // $this->authorize('delete', $data);
        $res = $logo->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();

    }

    public function order(Request $request)
    {
       
        $image = Logo::where('id',$request->id)->first();
        $image->order = $request->data;
        $res = $image->update();
        // dd($vehicle);
        if($res){
            $data['message'] = 'Order updated Successfully';
            $data['status'] = '1';
            return response()->json($data);
        }
    }
}
