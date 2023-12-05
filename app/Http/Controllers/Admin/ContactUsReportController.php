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
    public function view($id)
    {

        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Contact Report')), route('admin.enquiries.index')],
            [(__('View')), null],
        ];
        $quote = Contact::where('id', $id)->first();

        //  dd($quote);
        return view('admin.reports.contact_view',compact('quote','breadcrumbs'));
    }
    public function destroy($id)
    {
       
        $res = Contact::where('id',$id)->delete();
       
        // $content=SubService::where('section_id',$id)->first();
       
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
