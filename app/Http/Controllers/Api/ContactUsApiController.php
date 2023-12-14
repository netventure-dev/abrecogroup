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
        $data['contact'] = ContactUs::select('title', 'description', 'link', 'phone', 'address', 'map_link', 'image', 'mobile_image', 'seo_title', 'seo_description', 'seo_keywords', 'canonical_tag', 'schema')->get();
        // Check if 'image' field is empty and set it to null
        foreach ($data['contact'] as $contact) {
            if (empty($contact->image)) {
                $contact->image = null;
            }
        }
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
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:16',
            'message' => 'required',
            'organization' => 'required',
            'job' => 'required',
            'reason' => 'required',
            'refer' => 'required',

        ], [
            'phone.min' => 'The phone must be at least 7 characters.',
            'phone.max' => 'The phone must be Maximum 16 characters.',


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
            $details['admin_name'] = 'Admin';
            Notification::send($admin, new ContactNotification($details));
            Notification::route('mail', 'sunil.kumar@a3logics.in')->notify(new ContactNotification($details));
            Notification::route('mail', 'divya.jain@a3logics.in')->notify(new ContactNotification($details));
            Notification::route('mail', $details['email'])->notify(new ContactusNotification($details));
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        } else {
            return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
        }
    }
    // public function teststore(Request $request)
    // {
    //     // dd($request->all());

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|max:255',
    //         'email' => 'required|email|max:255',
    //         'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:16',
    //         'message' => 'required',
    //         'organization' => 'required',
    //         'job' => 'required',
    //         'reason' => 'required',
    //         'refer' => 'required',
    //         'recaptchaToken' => 'required',
    //     ], [
    //         'phone.min' => 'The phone must be at least 7 characters.',
    //         'phone.max' => 'The phone must be Maximum 16 characters.',
    //         // 'recaptchaToken.required' => 'The RecaptchaToken is required',
    //     ]);

    //     if ($validator->fails()) {
    //         $response = [
    //             'success' => false,
    //             'errors' => $validator->errors(),
    //             'input' => $request->all(),
    //         ];

    //         return response()->json($response, 422);
    //     }

    //     // Validate reCAPTCHA token
    //     $recaptchaToken = $request->input('recaptchaToken');
    //     // $recaptchaSecretKey = config('services.recaptcha.secret');
    //     $recaptchaSecretKey = '6LdN_zApAAAAAB4iW1nK_dWY0LxGLBFvTyQ4FDB_';


    //     $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
    //         'secret' => $recaptchaSecretKey,
    //         'response' => $recaptchaToken,
    //     ]);

    //     $recaptchaData = $response->json();
    //     dd($recaptchaData);



    //     if (!$recaptchaData['success']) {
    //         // reCAPTCHA verification failed
    //         $response = [
    //             'success' => false,
    //             'errors' => ['recaptchaToken' => ['The reCAPTCHA verification failed.']],
    //             'input' => $request->all(),
    //         ];

    //         return response()->json($response, 422);
    //     }

    //     // Continue processing the form data
    //     // ...

    //     return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
    // }
    public function teststore(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:16',
            'message' => 'required',
            'organization' => 'required',
            'job' => 'required',
            'reason' => 'required',
            'refer' => 'required',
            'recaptchaToken' => 'required',
        ], [
            'phone.min' => 'The phone must be at least 7 characters.',
            'phone.max' => 'The phone must be Maximum 16 characters.',
            // 'recaptchaToken.required' => 'The RecaptchaToken is required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'errors' => $validator->errors(),
                'input' => $request->all(),
            ];

            return response()->json($response, 422);
        }

        // Validate reCAPTCHA token
        $recaptchaToken = $request->input('recaptchaToken');
        $recaptchaSecretKey = '6LdN_zApAAAAAB4iW1nK_dWY0LxGLBFvTyQ4FDB_';

        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecretKey,
            'response' => $recaptchaToken,
        ]);

        $recaptchaData = $response->json();
        dd($recaptchaData);

        if (!$recaptchaData['success']) {
            // reCAPTCHA verification failed
            $response = [
                'success' => false,
                'errors' => ['recaptchaToken' => ['The reCAPTCHA verification failed.']],
                'input' => $request->all(),
            ];

            return response()->json($response, 422);
        }

        // Continue processing the form data
        // ...

        return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
    }
}
