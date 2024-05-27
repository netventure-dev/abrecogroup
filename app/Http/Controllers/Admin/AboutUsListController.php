<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AboutUsListDataTable;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutUsList;
use Illuminate\Support\Str;
use JoeDixon\Translation\Language;
use Illuminate\Http\Request;


class AboutUsListController extends Controller
{
    public function index(AboutUsListDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Core Values List')), null],
        ];
        return $dataTable->render('admin.about-us.list.index', ['breadcrumbs' => $breadcrumbs]);
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
            ['Core Values List', route('admin.about-us.list.index')],
            ['Create', route('admin.about-us.list.create')],
        ];
        return view('admin.about-us.list.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required|unique:about_us_lists,title',
            'content' => 'required',
            'image' => 'required| max:2000',
            'alt_text' => 'nullable',
            'canonical_tag' => 'nullable',
            'schema' => 'nullable',
            'status' => 'required',
        ]);
        $data = new AboutUsList;
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->canonical_tag = $validated['canonical_tag'];
        $data->schema = $validated['schema'];
        $data->content = $validated['content'];
        $data->alt_text = $validated['alt_text'];

        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/aboutus/image',$validated['image']->getClientOriginalName(), 'public');
            $data->icon = $path;
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
        $data= AboutUsList::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Core Values List')),  route('admin.about-us.list.index')],
            [$data->title, null],
        ];
        return view('admin.about-us.list.edit', compact('breadcrumbs','data'));
    }
    public function update(Request $request,$id)
    {
        // $this->authorize('create', Gender::class);
        $data= AboutUsList::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:about_us_lists,title,'.$data->id,
            'content' => 'required',
            'canonical_tag' => 'nullable',
            'schema' => 'nullable',
            'alt_text' => 'nullable',
            'image' => 'nullable| max:2000',
            'status' => 'required',
        ]);
        $data->title = $validated['title'];
        $data->canonical_tag = $validated['canonical_tag'];
        $data->schema = $validated['schema'];
        $data->content = $validated['content'];
        $data->status = $validated['status'];
        $data->alt_text = $validated['alt_text'];

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/aboutus/image',$validated['image']->getClientOriginalName(), 'public');
            $data->icon = $path;
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
        $res = AboutUsList::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted Successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    public function image_delete(Request $request)
    {

        $data = AboutUsList::where('uuid', $request->uuid)->first();
        // dd($data);
        $data->icon = "";
        $data->save();
        return response()->json(['status' => "success"]);
    }
}
