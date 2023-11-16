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
use Illuminate\Support\Facades\Validator;


class ServiceFormController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

    public function store(Request $request)
    {

        //     $details=[];
        //     $validated = $request->validate(
        //         [
        //             'name' => 'required|max:255',
        //             'email' => 'required|email|max:255',
        //             'service' => 'required',
        //             'type' => 'required',
        //             'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        //             'message' => 'nullable',
        //             // 'g-recaptcha-response' => 'required|captcha',


        //         ],
        //     );

        //     $request = new Quote();
        //     $request->name = $validated['name'];
        //     $request->email = $validated['email'];
        //     $request->service = $validated['service'];
        //     $request->type = $validated['type'];
        //     $request->phone = $validated['phone'];
        //     $request->message = $validated['message'];
        //     // dd($feedbacks);
        //     $res = $request->save();
        //     //  return view('request-a-quote.show'); 
        //     if($res) {

        //         $admin = Admin::first();
        //         $details['name'] = $validated['name'];
        //         $details['service'] = $validated['service'];
        //         $details['phone'] = $validated['phone'];
        //         $details['email'] = $validated['email'];
        //         $details['type'] = $validated['type'];
        //         $details['message'] = $validated['message'];
        //         $details['admin_name'] = $admin->name;
        //         Notification::send($admin, new QuoteNotification($details));
        //         Notification::route('mail', $details['email'])->notify(new QuotessNotification($details));
        //         return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        //     }
        //     return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
        // }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'service' => 'required',
            'type' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:16',
            'message' => 'nullable',
            // 'g-recaptcha-response' => 'required|captcha',

        ], [
            'phone.min' => 'The phone must be at least 7 characters.',
            'phone.max' => 'The phone must be at Maximum 16 characters.',


        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'errors' => $validator->errors(),
                'input' => request()->all(),
            ];

            return response()->json($response);
        }

        $data = new Quote();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->service = $request['service'];
        $data->type = $request['type'];
        $data->phone = $request['phone'];
        $data->message = $request['message'];

        $res = $data->save();

        if ($res) {
            $admin = Admin::first();
            $details['name'] = $request['name'];
            $details['email'] = $request['email'];
            $details['service'] = $request['service'];
            $details['position'] = $request['position'];
            $details['type'] = $request['type'];
            $details['phone'] = $request['phone'];
            $details['message'] = $request['message'];
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new QuoteNotification($details));
            Notification::route('mail', $details['email'])->notify(new QuotessNotification($details));
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        } else {
            return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
        }
    }
}
