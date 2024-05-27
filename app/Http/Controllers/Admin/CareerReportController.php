<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CareerReportDataTable;
use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerReportController extends Controller
{
    public function index(CareerReportDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Career Report')), null],
        ];
        return $dataTable->render('admin.reports.career.index', ['breadcrumbs' => $breadcrumbs]);
    }
    public function view($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Career Report')),route('admin.careerenquiry.index')],
            [(__('View')),null],
        ];

        $quote = Career::where('id', $id)->first();

        return view('admin.reports.career.view', compact('quote','breadcrumbs'));
    }
    public function destroy($id)
    {
       
        $res = Career::where('uuid',$id)->delete();
       
        // $content=SubService::where('section_id',$id)->first();
       
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
