<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\CareerSettings;
use App\Models\CareerOpening;
use App\Admin;
use App\Notifications\CareerNotification;
use App\Notifications\CareerAdminNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CareerApiController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

    public function index(Request $request)
    {
        $data['career'] = CareerOpening::select('uuid', 'position', 'description', 'experience', 'seo_title', 'seo_description', 'seo_keywords','canonical_tag','schema')->where('status', 1)->get();
        $data['career_settings'] = CareerSettings::select('uuid', 'title','sub_title','banner_image','mobile_image', 'seo_title', 'seo_description', 'seo_keywords','canonical_tag','schema')->first();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    public function store(Request $request)
    {
        //return 2;
        //     $validated = $request->validate(
        //         [
        //             'name' => 'required|max:255',
        //             'email' => 'required|email|max:255',
        //             'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        //             'message' => 'required',
        //             'position' => 'required',
        //             'resume' => 'required|mimes:pdf|max:5000',
        //             // 'g-recaptcha-response' => 'required|captcha',

        //         ],  [
        //             'resume.max' => 'The resume may not be greater than 2 mb.',
        //         ]);
        //     // return 1;
        //     $data = new Career();
        //     $data->uuid = (string) Str::uuid();
        //     $data->name = $validated['name'];
        //     $data->email = $validated['email'];
        //     $data->phone = $validated['phone'];
        //     $data->position = $validated['position'];
        //     if ($request->hasFile('resume')) {
        //         $path =  $request->file('resume')->storeAs('media/career/file', $validated['resume']->getClientOriginalName(), 'public');
        //         $data->resume = $path;
        //     }
        //     $data->message = $validated['message'];
        //     // dd($data);
        //     $res = $data->save();
        //     // return view('contact_us.show');

        //     if ($res) {
        //         $admin = Admin::first();
        //         $details['name'] = $validated['name'];
        //         $details['email'] = $validated['email'];
        //         $details['phone'] = $validated['phone'];
        //         $details['position'] = $validated['position'];
        //         $details['message'] = $validated['message'];
        //         $details['resume'] = $data->resume;
        //         $details['admin_name'] = $admin->name;
        //         Notification::send($admin, new CareerAdminNotification($details));
        //         Notification::route('mail', $details['email'])->notify(new CareerNotification($details));
        //         return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        //     } else {
        //         return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
        //     }
        // }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'message' => 'required',
            'position' => 'required',
            'resume' => 'required|mimes:pdf|max:2048'

        ], [
            'resume.max' => 'The resume may not be greater than 2 mb.',
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

        $data = new Career();
        $data->uuid = (string) Str::uuid();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->phone = $request['phone'];
        $data->position = $request['position'];
        if ($request->hasFile('resume')) {
            $path =  $request->file('resume')->storeAs('media/career/file', $request['resume']->getClientOriginalName(), 'public');
            $data->resume = $path;
        }
        $data->message = $request['message'];

        $res = $data->save();

        if ($res) {
            $admin = Admin::first();
            $details['name'] = $request['name'];
            $details['email'] = $request['email'];
            $details['phone'] = $request['phone'];
            $details['position'] = $request['position'];
            $details['message'] = $request['message'];
            $details['resume'] = $data->resume;
            $details['admin_name'] = 'Admin';
            Notification::send($admin, new CareerAdminNotification($details));
            Notification::route('mail', 'sunil.kumar@a3logics.in')->notify(new CareerAdminNotification($details));
            Notification::route('mail', 'divya.jain@a3logics.in')->notify(new CareerAdminNotification($details));
            Notification::route('mail', $details['email'])->notify(new CareerNotification($details));
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $details], $this->successStatus);
        } else {
            return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $details], $this->failedStatus);
        }
    }
}
