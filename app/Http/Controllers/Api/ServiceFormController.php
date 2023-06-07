<?php

namespace App\Http\Controllers\Api;

use App\Admin;
use App\Models\Quote;
use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Notifications\QuoteNotification;
use App\Notifications\QuotessNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ServiceFormController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

    public function store(Request $request)
    {
        $details=[];
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'service' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'message' => 'nullable',
                // 'g-recaptcha-response' => 'required|captcha',

            ],
        );
        $request = new Quote();
        $request->name = $validated['name'];
        $request->email = $validated['email'];
        $request->service = $validated['service'];
        $request->phone = $validated['phone'];
        $request->message = $validated['message'];
        // dd($feedbacks);
        $res = $request->save();
        //  return view('request-a-quote.show'); 
        
        if($res) {

            $admin = Admin::first();
            $details['name'] = $validated['name'];
            $details['service'] = $validated['service'];
            $details['phone'] = $validated['phone'];
            $details['email'] = $validated['email'];
            $details['message'] = $validated['message'];
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new QuoteNotification($details));
            Notification::route('mail', $details['email'])->notify(new QuotessNotification($details));
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
    }
}
