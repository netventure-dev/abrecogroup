<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RequestQuoteReportDataTable;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class RequestQuoteReportController extends Controller
{
    public function index(RequestQuoteReportDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Request Report')), null],
        ];
        return $dataTable->render('admin.reports.request', ['breadcrumbs' => $breadcrumbs]);
    }
    public function view($id)
    {
        $breadcrumbs = [
            [__('Dashboard'), route('admin.home')],
            [__('Service Enquiry'), route('admin.requestenquiry.index')],
            [(__('View')), null],
        ];

        $quote = Quote::where('id', $id)->first();
        // dd($quote);
        return view('admin.reports.view', compact('quote','breadcrumbs'));
    }
    public function destroy($id)
    {
       
        $res = Quote::where('uuid',$id)->delete();
       
        // $content=SubService::where('section_id',$id)->first();
       
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
