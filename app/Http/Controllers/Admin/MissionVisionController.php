<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MissionVisionDataTable;
use App\Http\Controllers\Controller;
use App\Models\MissionVision;
use Illuminate\Support\Str;
use JoeDixon\Translation\Language;
use Illuminate\Http\Request;

class MissionVisionController extends Controller
{
    public function index(MissionVisionDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Mission & Vision')), null],
        ];
        return $dataTable->render('admin.about-us.mission-vision.index', ['breadcrumbs' => $breadcrumbs]);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Mission & Vision',null],
            ['Create', route('admin.mission-vision.create')],
        ];
        $data = MissionVision::first();
        return view('admin.about-us.mission-vision.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'mission_title' => 'nullable',
            'mission_content' => 'nullable',
            'mission_image' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
            'vision_title' => 'nullable',
            'vision_content' => 'nullable',
            'vision_image' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
            'values_title' => 'nullable',
            'values_content' => 'nullable',
            'values_image' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
        ]);
        // $data = AboutUs::firstOrCreate();
        $data = MissionVision::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->mission_title = $validated['mission_title'];
        $data->mission_content = $validated['mission_content'];
        $data->vision_title = $validated['vision_title'];
        $data->vision_content = $validated['vision_content'];
        $data->values_title = $validated['values_title'];
        $data->values_content = $validated['values_content'];
        if ($request->hasFile('mission_image')) {
            $path =  $request->file('mission_image')->storeAs('media/aboutus/image',  $validated['mission_image']->getClientOriginalName(), 'public');
            $data->mission_image = $path;
        }
      
        if ($request->hasFile('vision_image')) {
            $path =  $request->file('vision_image')->storeAs('media/aboutus/image',$validated['vision_image']->getClientOriginalName(), 'public');
            $data->vision_image = $path;
        }
        if ($request->hasFile('values_image')) {
            $path =  $request->file('values_image')->storeAs('media/aboutus/image',  $validated['values_image']->getClientOriginalName(), 'public');
            $data->values_image = $path;
        }
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created Successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    // public function edit($id)
    // {
    //     // $this->authorize('update', $menu);
    //     $data= MissionVision::where('uuid',$id)->first();
    //     $breadcrumbs = [
    //         [(__('Dashboard')), route('admin.home')],
    //         [(__('Mission & Vision')),  route('admin.mission-vision.index')],
    //         [$data->title, null],
    //     ];
    //     return view('admin.about-us.mission-vision.edit', compact('breadcrumbs','data'));
    // }
    // public function update(Request $request,$id)
    // {
    //     // $this->authorize('create', Gender::class);
    //     $data= MissionVision::where('uuid',$id)->first();
    //     $validated = $request->validate([
    //         'mission_title' => 'required',
    //         'mission_content' => 'nullable',
    //         'mission_image' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
    //         'vision_title' => 'required',
    //         'vision_content' => 'nullable',
    //         'vision_image' => 'sometimes|mimes:jpg,jpeg,png,webp|max:2000',
    //     ]);
    //     $data->mission_title = $validated['mission_title'];
    //     $data->mission_content = $validated['mission_content'];
    //     $data->vision_title = $validated['vision_title'];
    //     $data->vision_content = $validated['vision_content'];

    //     if ($request->hasFile('mission_image')) {
    //         $path =  $request->file('mission_image')->storeAs('media/aboutus/image',$validated['mission_image']->getClientOriginalName(), 'public');
    //         $data->mission_image = $path;
    //     }
    //     if ($request->hasFile('vision_image')) {
    //         $path =  $request->file('vision_image')->storeAs('media/aboutus/image',$validated['vision_image']->getClientOriginalName(), 'public');
    //         $data->vision_image = $path;
    //     }
    //     $res = $data->save();
    //     if ($res) {
    //         notify()->success(__('Updated Successfully'));
    //     } else {
    //         notify()->error(__('Failed to create. Please try again'));
    //     }
    //     return redirect()->back();
    // }
    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = MissionVision::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted Successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

    public function image_delete(Request $request)
    {

        $data = MissionVision::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->vision_image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }

    public function image_delete1(Request $request)
    {

        $section = MissionVision::where('uuid', $request->uuid)->first();
        $section->mission_image = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
    public function image_delete2(Request $request)
    {

        $section = MissionVision::where('uuid', $request->uuid)->first();
        $section->values_image = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
}
