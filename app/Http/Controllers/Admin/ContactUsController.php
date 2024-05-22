<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Support\Str;
class ContactUsController extends Controller
{
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Contact Us', route('admin.contact-us.create')],
        ];
        $data = ContactUs::first();
        return view('admin.contact-us.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'address' => 'nullable',
        ]);
        $data = ContactUs::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->description = $validated['description'];
        $data->email = $validated['email'];
        $data->phone = $validated['phone'];
        $data->address = $validated['address'];
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

        $data = ContactUs::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }

    public function image_delete1(Request $request)
    {

        $data = ContactUs::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->mobile_image = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }

}
