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
        // $breadcrumbs = [
        //     [(__('Dashboard')), route('admin.home')],
        //     [(__('Career Report')), null],
        // ];

        $quote = Career::where('id', $id)->first();

        return view('admin.reports.career.view', compact('quote'));
    }
}
