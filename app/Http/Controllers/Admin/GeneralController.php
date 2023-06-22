<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Models\General;
use Illuminate\Support\Str;

class GeneralController extends Controller
{
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['General', route('admin.general.create')],
        ];
        $data = General::first();
        return view('admin.general.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'address' => 'required',
            'site_title' => 'required',
            'phone' => 'nullable',
            'email' => 'required',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'light_logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'facebook' => 'required',
            'instagram' => 'required',
            'linkdln' => 'required',
            'youtube' => 'required',
            'twitter' => 'required',
            'favicon' => 'nullable',
        ]);
        $data = General::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->site_title = $validated['site_title'];
        $data->address = $validated['address'];
        $data->mobile = $validated['phone'];
        $data->email = $validated['email'];
        $data->facebook = $validated['facebook'];
        $data->instagram = $validated['instagram'];
        $data->linkdln = $validated['linkdln'];
        $data->twitter = $validated['twitter'];
        $data->youtube = $validated['youtube'];
        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs('media/general/image',$validated['logo']->getClientOriginalName(), 'public');
            $data->logo = $path;
        }
        if ($request->hasFile('light_logo')) {
            $path =  $request->file('light_logo')->storeAs('media/general/image', $validated['light_logo']->getClientOriginalName(), 'public');
            $data->light_logo = $path;
        }
        if ($request->hasFile('favicon')) {
            $path1 =  $request->file('favicon')->storeAs('media/general/image',$validated['favicon']->getClientOriginalName(), 'public');
            $data->favicon = $path1;
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
