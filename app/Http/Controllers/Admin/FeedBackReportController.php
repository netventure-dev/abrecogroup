<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FeedbackReportDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedBackReportController extends Controller
{
    public function index(FeedbackReportDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Feedback Report')), null],
        ];
        return $dataTable->render('admin.reports.feedback', ['breadcrumbs' => $breadcrumbs]);
    }
}
