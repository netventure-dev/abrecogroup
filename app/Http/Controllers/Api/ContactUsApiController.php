<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactUs;
use App\Admin;
use App\Notifications\ContactNotification;
use App\Notifications\ContactusNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;



class ContactUsApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
    //ContactUs
    public function contact()
    {
        // dd(1);
        $data['contact'] = ContactUs::select('title', 'description', 'link', 'phone', 'address', 'map_link', 'image', 'seo_title', 'seo_description', 'seo_keywords','canonical_tag')->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    public function store(Request $request)
    {
        // //return 2;
        // $validated = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|max:255',
        //     'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        //     'message' => 'required',
        //     'organization' => 'required',
        //     'job' => 'required',
        //     'reason' => 'required',
        //     'refer' => 'required',
        //     // 'g-recaptcha-response' => 'required|captcha',
        // ]);
        // // return 1;
        // $data = new Contact();
        // $data->name = $validated['name'];
        // $data->email = $validated['email'];
        // $data->phone = $validated['phone'];
        // $data->organization = $validated['organization'];
        // $data->job = $validated['job'];
        // $data->reason = $validated['reason'];
        // $data->refer = $validated['refer'];
        // $data->message = $validated['message'];
        // // dd($data);
        // $res = $data->save();
        // // return view('contact_us.show');

        // if ($res) {
        //     $admin = Admin::first();
        //     $details['name'] = $validated['name'];
        //     $details['email'] = $validated['email'];
        //     $details['phone'] = $validated['phone'];
        //     $details['organization'] = $validated['organization'];
        //     $details['job'] = $validated['job'];
        //     $details['refer'] = $validated['refer'];
        //     $details['reason'] = $validated['reason'];
        //     $details['message'] = $validated['message'];
        //     $details['admin_name'] = $admin->name;
        //     Notification::send($admin, new ContactNotification($details));
        //     Notification::route('mail', $details['email'])->notify(new ContactusNotification($details));
        //     return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        // } else {
        //     return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
        // }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required',
            'organization' => 'required',
            'job' => 'required',
            'reason' => 'required',
            'refer' => 'required',

        ], [
            'phone.min' => 'The phone must be at least 10 characters.',

        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'errors' => $validator->errors(),
                'input' => request()->all(),
            ];

            return response()->json($response);
        }

        $data = new Contact();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->phone = $request['phone'];
        $data->message = $request['message'];
        $data->organization = $request['organization'];
        $data->job = $request['job'];
        $data->reason = $request['reason'];
        $data->refer = $request['refer'];
        $res = $data->save();

        if ($res) {
            $admin = Admin::first();
            $details['name'] = $request['name'];
            $details['email'] = $request['email'];
            $details['phone'] = $request['phone'];
            $details['message'] = $request['message'];
            $details['organization'] = $request['organization'];
            $details['job'] = $request['job'];
            $details['reason'] = $request['reason'];
            $details['refer'] = $request['refer'];
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new ContactNotification($details));
            Notification::route('mail', $details['email'])->notify(new ContactusNotification($details));
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        } else {
            return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
        }
    }
}
