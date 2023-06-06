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
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'cover_content' => 'required',
            'alt_text' => 'nullable',
            'banner_image' => 'sometimes|required| max:2000',
            'image' => 'required| max:2000',
            'link' => 'nullable',
            'status' => 'required',
        ]);
        $data = AboutUs::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->cover_title = $validated['title'];
        $data->cover_content = $validated['cover_content'];
        $data->content = $validated['content'];
        $data->alt_text = $validated['alt_text'];
        $data->link = $validated['link'];
        $data->status = $validated['status'];
        if ($request->hasFile('banner_image')) {
            $path =  $request->file('banner_image')->storeAs('media/aboutus/image/',$validated['banner_image']->getClientOriginalName(), 'public');
            $data->banner_image = $path;
        }
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/aboutus/image/',$validated['image']->getClientOriginalName(), 'public');
            $data->content_image = $path;
        }
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }

}
