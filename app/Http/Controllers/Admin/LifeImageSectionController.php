<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LifeImageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class LifeImageSectionController extends Controller
{
    public function create()
    {
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['News', route('admin.news.index')],
            ['Create', route('admin.blog-list.create')],
        ];
        $data = LifeImageSection::first();
        // $news = AbrecoWorkingPrinclpleList::paginate(10);


        return view('admin.life-abreco.image-section.create', compact('breadcrumbs', 'data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'button_title' => 'nullable',
            'button_url' => 'nullable',


        ]);
        $data = LifeImageSection::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->button_title = $validated['button_title'];
        $data->button_url = $validated['button_url'];
        $data->content = $validated['content'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/testimonials/image/', $validated['image']->getClientOriginalName(), 'public');
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
