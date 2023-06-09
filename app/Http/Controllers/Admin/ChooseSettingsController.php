<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WhyChooseUsSettingsDataTable;
use App\Http\Controllers\Controller;
use App\Models\WhyChooseUsSettings;
use Illuminate\Support\Str;
use JoeDixon\Translation\Language;
use Illuminate\Http\Request;

class ChooseSettingsController extends Controller
{

    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Why Choose Us Settings', route('admin.why-choose-us.settings.create')],
            ['Create', route('admin.why-choose-us.settings.create')],
        ];
        $data = WhyChooseUsSettings::first();
        return view('admin.why-choose-us.settings.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'sometimes|required|mimes:jpg,jpeg,png,webp|max:2000',
            'status' => 'required',
        ]);
        $data = WhyChooseUsSettings::firstOrNew();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->description = $validated['content'];
        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/why_choose/image',$validated['image']->getClientOriginalName(), 'public');
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
   
}
