<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CounterController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Counter', route('admin.couters.index')],
        ];
        $counter = Counter::paginate(10);
        return view('admin.about-us.counter.index', compact('breadcrumbs','counter'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'counter' => 'nullable',
            'order' => 'required|integer|min:0|unique:counters,order', 
            'status' => 'required',
        ]);
        $data = new Counter();
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->counter = $validated['counter'];
        $data->order = $validated['order'];
        $data->status= $validated['status'];
        $res = $data->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();    
    }
    public function edit($id)
    {
        $data = Counter::where('uuid',$id)->firstOrFail();
    
        $breadcrumbs = [
            [__('Dashboard'), route('admin.home')],
            ['Counter', route('admin.couters.index')],
            ['Edit', Null],
        ];
    
        return view('admin.about-us.counter.edit', compact('breadcrumbs', 'data'));
    }
    public function update(Request $request,$id)
    {
        $data= Counter::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required',
            'counter' => 'nullable',
            'order' => [
                'required',
                'integer',
                'min:0',
                Rule::unique('counters', 'order')->ignore($data->id),
            ],
            'status' => 'required',
        ]);

        $data->title = $validated['title'];
        $data->counter = $validated['counter'];
        $data->order = $validated['order'];
        $data->status= $validated['status'];
        $res = $data->save();

        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to update. Please try again'));
        }
        return redirect()->back();
    }
    public function destroy(Request $request, $id)
    {
          
        $impact = Counter::where('uuid', $id)->first();
        $res = $impact->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
