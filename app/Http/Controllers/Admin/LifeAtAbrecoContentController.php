<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LifeAtAbrecoContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class LifeAtAbrecoContentController extends Controller
{
    public function create()
    {
        
        
        // $this->authorize('create', Admin::class);
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['News', route('admin.news.index')],
            ['Create', route('admin.blog-list.create')],
        ];
        $data = LifeAtAbrecoContent::first();

        return view('admin.life-abreco.content.create', compact('breadcrumbs','data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'nullable',
            'content' => 'nullable',


        ]);
        $data = LifeAtAbrecoContent::firstOrCreate();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->content = $validated['content'];
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
}
