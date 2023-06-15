<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RequestQuoteReportDataTable;
use App\Http\Controllers\Controller;
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
}
