<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ContactUsReportDataTable;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Str;
use JoeDixon\Translation\Language;
use Illuminate\Http\Request;

class ContactUsReportController extends Controller
{
    public function index(ContactUsReportDataTable $dataTable)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Enquiry Report')), null],
        ];
        return $dataTable->render('admin.reports.contact_us', ['breadcrumbs' => $breadcrumbs]);
    }
}
