<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Models\Feedback;
use App\Notifications\FeedBackNotification;
use App\Notifications\FeedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback.show');
    }

    public function store(Request $request)
    {
        // return 1;
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'message' => 'nullable',
                'g-recaptcha-response' => 'required|captcha',
              
            ],  
        );
        // return 1;
        $feedbacks = new Feedback();
        $feedbacks->name = $validated['name'];
        $feedbacks->email = $validated['email'];
        $feedbacks->phone = $validated['phone'];
        $feedbacks->message = $validated['message'];
        // dd($feedbacks);
        $res = $feedbacks->save();
       
        if ($res) {
            $admin = Admin::first();
            $details['name'] = $validated['name'];
            $details['email'] = $validated['email'];
            $details['phone'] = $validated['phone'];
            $details['message'] = $validated['message'];
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new FeedNotification($details));
            Notification::route('mail', $validated['email'])->notify(new FeedBackNotification($details));
            // return view('feedback.show');
            return redirect('thank-you')->with('status', '1');
        } else {
            return redirect()->back()->with('error', 'Failed to contact us. Please try again.');
        }
    }
    

}
