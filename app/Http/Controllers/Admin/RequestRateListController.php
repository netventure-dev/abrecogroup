<?php


namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RequestRateListDataTable;
use App\Http\Controllers\Controller;
use App\Models\RequestRateContent;
use App\Models\ServiceCare;
use Illuminate\Support\Str;
use JoeDixon\Translation\Language;
use Illuminate\Http\Request;

class RequestRateListController extends Controller
{
    public function index(RequestRateListDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Request Rate List')), null],
        ];
        return $dataTable->render('admin.request.list.index', ['breadcrumbs' => $breadcrumbs]);
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
            ['Request Rate List', route('admin.request.list.index')],
            ['Create', route('admin.request.list.create')],
        ];
        $service_cares=ServiceCare::where('status',1)->get();
        return view('admin.request.list.create', compact('breadcrumbs','service_cares'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'title' => 'required|unique:request_rate_contents,title',
            'content' => 'required',
            'service_care_id' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp | max:2000',
            'status' => 'required',
        ]);
        $data = new RequestRateContent;
        $data->uuid = (string) Str::uuid();
        $data->title = $validated['title'];
        $data->service_care_id = $validated['service_care_id'];
        $data->content = $validated['content'];
        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/service_care/image/',$validated['image']->getClientOriginalName(), 'public');
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
    public function edit($id)
    {
        // $this->authorize('update', $menu);
        $data= RequestRateContent::where('uuid',$id)->first();
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Request Rate List')),  route('admin.request.list.index')],
            [$data->title, null],
        ];
        return view('admin.request.list.edit', compact('breadcrumbs','data'));
    }
    public function update(Request $request,$id)
    {
        // $this->authorize('create', Gender::class);
        $data= RequestRateContent::where('uuid',$id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:request_rate_contents,title,'.$data->id,
            'content' => 'required',
            'service_care_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp | max:2000',
            'status' => 'required',
        ]);
        $data->title = $validated['title'];
        $data->service_care_id = $validated['service_care_id'];
        $data->content = $validated['content'];
        $data->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs('media/request/image/',$validated['image']->getClientOriginalName(), 'public');
            $data->image = $path;
        }
        $res = $data->save();
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = RequestRateContent::where('uuid',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
