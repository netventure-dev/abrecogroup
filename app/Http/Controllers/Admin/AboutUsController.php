<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AboutUsDataTable;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Support\Str;

class AboutUsController extends Controller
{
    public function index(BlogDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('About Us')), null],
        ];
        return $dataTable->render('admin.about-us.settings.create', ['breadcrumbs' => $breadcrumbs]);
    }
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['About Us', route('admin.about-us.settings.create')],
        ];
        $data = AboutUs::first();
        return view('admin.about-us.settings.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'sub_title'=>'nullable',
            'content' => 'nullable',
            'sub_content' => 'nullable',
            'banner_image' => 'sometimes|required| max:2000',
        ]);
        $data = AboutUs::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->sub_title = $validated['sub_title'];
        $data->content = $validated['content'];
        $data->sub_content = $validated['sub_content'];
        if ($request->hasFile('banner_image')) {
            $path =  $request->file('banner_image')->storeAs('media/aboutus/image',$validated['banner_image']->getClientOriginalName(), 'public');
            $data->image = $path;
        }
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

    public function image_delete(Request $request)
    {

        $data = AboutUs::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }

    

}
