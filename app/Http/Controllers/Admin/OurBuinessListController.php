<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessList;
use Illuminate\Http\Request;

class OurBuinessListController extends Controller
{
    public function logos()  {
        $user = auth()->guard('admin')->user();
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            // ['Bussiness', route('admin.logos.index')],
        ];
        $logos = BusinessList::get();

    //    dd($logos);
        return view('admin.business.list.create',compact('user','breadcrumbs','logos'));
    }

    public function store(Request $request)
    {
        $image =$request->file('file');
        $imageUpload = new BusinessList();
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
                $imageUpload->work_id = '';
                $imageUpload->save();
            // return response()->json(['success'=>$avatarName]);
            return redirect()->back()->with('success', 'Successfully added Client logo.');
        }
    }

    public function title(Request $request)
    {
       
        $image = BusinessList::where('id',$request->id)->first();
        $image->title = $request->data;
        $res = $image->update();
        // dd($vehicle);
        if($res){
            $data['message'] = 'Title updated Successfully';
            $data['status'] = '1';
            return response()->json($data);
        }
    }


    public function logo_destroy($id)
    {

        
        $logo = BusinessList::where('id',$id)->first();

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
