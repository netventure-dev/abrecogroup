<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Admin;
use App\Notifications\CareerNotification;
use App\Notifications\CareerAdminNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CareerApiController extends Controller
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
                'position' => 'required',
                'resume' => 'required|mimes:pdf|max:5000',
                // 'g-recaptcha-response' => 'required|captcha',

            ],
        );
        // return 1;
        $data = new Career();
        $data->uuid = (string) Str::uuid();
        $data->name = $validated['name'];
        $data->email = $validated['email'];
        $data->phone = $validated['phone'];
        $data->position = $validated['position'];
        if ($request->hasFile('resume')) {
            $path =  $request->file('resume')->storeAs('media/career/file', $validated['resume']->getClientOriginalName(), 'public');
            $data->resume = $path;
        }
        $data->message = $validated['message'];
        // dd($data);
        $res = $data->save();
        // return view('contact_us.show');

        if ($res) {
            $admin = Admin::first();
            $details['name'] = $validated['name'];
            $details['email'] = $validated['email'];
            $details['phone'] = $validated['phone'];
            $details['position'] = $validated['position'];
            $details['message'] = $validated['message'];
            $details['resume'] = $data->resume;
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new CareerAdminNotification($details));
            Notification::route('mail', $details['email'])->notify(new CareerNotification($details));
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        } else {
            return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
        }
    }
}
