<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Admin;
use App\Notifications\ContactNotification;
use App\Notifications\ContactusNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ContactUsApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

    public function store(Request $request)
    {
        //return 2;
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'message' => 'required',
                'organization' => 'required',
                'job' => 'required',
                'refer' => 'required',
                // 'g-recaptcha-response' => 'required|captcha',

            ],
        );
        // return 1;
        $data = new Contact();
        $data->name = $validated['name'];
        $data->email = $validated['email'];
        $data->phone = $validated['phone'];
        $data->organization = $validated['organization'];
        $data->job = $validated['job'];
        $data->refer = $validated['refer'];
        $data->message = $validated['message'];
        // dd($data);
        $res = $data->save();
        // return view('contact_us.show');

        if ($res) {
            $admin = Admin::first();
            $details['name'] = $validated['name'];
            $details['email'] = $validated['email'];
            $details['phone'] = $validated['phone'];
            $details['organization'] = $validated['organization'];
            $details['job'] = $validated['job'];
            $details['refer'] = $validated['refer'];
            $details['message'] = $validated['message'];
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new ContactNotification($details));
            Notification::route('mail', $details['email'])->notify(new ContactusNotification($details));
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        } else {
            return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
        }
    }
}
