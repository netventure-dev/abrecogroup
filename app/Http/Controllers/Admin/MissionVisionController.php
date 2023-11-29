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
            ['Mission & Vision', route('admin.mission-vision.index')],
            ['Create', route('admin.mission-vision.create')],
        ];
        return view('admin.about-us.mission-vision.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required|unique:about_us_lists,title',
            'canonical_tag' => 'nullable',
            'content' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_image' => 'required|mimes:jpg,jpeg,png,webp|max:2000',
            'schema' => 'nullable',
            'status' => 'required',
        ]);
        $data = new MissionVision;
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->canonical_tag = $validated['canonical_tag'];
        $data->schema = $validated['schema'];
        $data->description = $validated['content'];
        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/aboutus/image',$validated['image']->getClientOriginalName(), 'public');
            $data->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/aboutus/image',$validated['mobile_image']->getClientOriginalName(), 'public');
            $data->mobile_image = $path;
        }
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created Successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        // $this->authorize('update', $menu);
        $data= MissionVision::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Mission & Vision')),  route('admin.mission-vision.index')],
            [$data->title, null],
        ];
        return view('admin.about-us.mission-vision.edit', compact('breadcrumbs','data'));
    }
    public function update(Request $request,$id)
    {
        // $this->authorize('create', Gender::class);
        $data= MissionVision::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:about_us_lists,title,'.$data->id,
            'content' => 'required',
            'canonical_tag' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'mobile_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'schema' => 'nullable',
            'status' => 'required',
        ]);
        $data->title = $validated['title'];
        $data->canonical_tag = $validated['canonical_tag'];
        $data->schema = $validated['schema'];
        $data->description = $validated['content'];
        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/aboutus/image',$validated['image']->getClientOriginalName(), 'public');
            $data->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path =  $request->file('mobile_image')->storeAs('media/aboutus/image',$validated['mobile_image']->getClientOriginalName(), 'public');
            $data->mobile_image = $path;
        }
        $res = $data->save();
        if ($res) {
            notify()->success(__('Updated Successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
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
        $data->image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }

    public function image_delete1(Request $request)
    {

        $section = MissionVision::where('uuid', $request->uuid)->first();
        $section->mobile_image = "";
        $section->save();
        return response()->json(['status' => "success"]);
    }
}
