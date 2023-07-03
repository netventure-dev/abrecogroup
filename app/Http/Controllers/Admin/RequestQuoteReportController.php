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
        $quote = Quote::where('id', $id)->first();
        // dd($quote);
        return view('admin.reports.view', compact('quote'));
    }
}
