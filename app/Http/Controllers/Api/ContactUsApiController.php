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
use Illuminate\Support\Facades\Http;




class ContactUsApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
    //ContactUs
    public function contact()
    {
        // dd(1);
        $data['contact'] = ContactUs::select('title', 'description', 'phone', 'address', 'email')->get();
        // Check if 'image' field is empty and set it to null
        // foreach ($data['contact'] as $contact) {
        //     if (empty($contact->image)) {
        //         $contact->image = null;
        //     }
        // }
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function contact_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            // 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:16',
            'subject' => 'required',
            'message' => 'required',
            // 'recaptchaToken' => 'required|string',


        ], [
            'phone.min' => 'The phone must be at least 7 characters.',
            'phone.max' => 'The phone must be Maximum 16 characters.',


        ]);



        $data = new Contact();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->subject = $request['subject'];
        $data->message = $request['message'];
        $res = $data->save();

        // if ($res) {
        //     $admin = Admin::first();
        //     $details['name'] = $request['name'];
        //     $details['email'] = $request['email'];
        //     $details['subject'] = $request['subject'];
        //     $details['message'] = $request['message'];
        //     $details['admin_name'] = 'Admin';
        //     Notification::send($admin, new ContactNotification($details));
        //     Notification::route('mail', 'sunil.kumar@a3logics.in')->notify(new ContactNotification($details));
        //     Notification::route('mail', 'divya.jain@a3logics.in')->notify(new ContactNotification($details));
        //     Notification::route('mail', $details['email'])->notify(new ContactusNotification($details));
        //     return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        // } else {
        //     return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
        // }
        if ($res) {
            return response()->json(['code' => 200, 'message' => 'Successful'], $this->successStatus);
        }
    }
  
    // public function teststore(Request $request)
    //  {
    //         // Validate the form data
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|max:255',
    //             'email' => 'required|email|max:255',
    //             'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:16',
    //             'message' => 'required',
    //             'organization' => 'required',
    //             'job' => 'required',
    //             'reason' => 'required',
    //             'refer' => 'required',
    //             'recaptchaToken' => 'required|string',
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json(['errors' => $validator->errors()], 422);
    //         }

    //         $secretKey = env('RECAPTCHA_SECRET_KEY');


    //         $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $request->post('recaptchaToken'));

    //         $responseData = $response->json();


    //         if (!$responseData['success']) {
    //             return response()->json([
    //                 'message' => 'reCAPTCHA validation failed',
    //                 'error-codes' => $responseData['error-codes'],
    //             ], 422);
    //         }


    //         return response()->json([
    //             'message' => 'Your message has been sent successfully!',
    //         ]);
    //     }
}
