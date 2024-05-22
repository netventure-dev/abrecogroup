<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DreamDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DreamDestinationController extends Controller
{
    public function create()
    {
        
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['News', route('admin.news.index')],
            ['Create', route('admin.blog-list.create')],
        ];
        $data = DreamDestination::first();

        return view('admin.dream-destination.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'nullable',
            'quote' => 'nullable',
            'content' => 'nullable',
            'author' => 'nullable',
            'position' => 'nullable',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2000',


        ]);
        $data = DreamDestination::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->quote = $validated['quote'];
        $data->content = $validated['content'];
        $data->author = $validated['author'];
        $data->position = $validated['position'];



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
