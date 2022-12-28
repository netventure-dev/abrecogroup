<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Models\Contact;
use App\Notifications\ContactNotification;
use App\Notifications\ContactusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact_us.show');
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
        $feedbacks = new Contact();
        $feedbacks->name = $validated['name'];
        $feedbacks->email = $validated['email'];
        $feedbacks->phone = $validated['phone'];
        $feedbacks->message = $validated['message'];
        // dd($feedbacks);
        $res = $feedbacks->save();
        // return view('contact_us.show');

        if ($res) {
            $admin = Admin::first();
            $details['name'] = $validated['name'];
            $details['email'] = $validated['email'];
            $details['phone'] = $validated['phone'];
            $details['message'] = $validated['message'];
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new ContactNotification($details));
            Notification::route('mail', $admin->email)->notify(new ContactusNotification($admin));
            return view('contact_us.show');
        } else {
            return redirect()->back()->with('error', 'Failed to contact us. Please try again.');
        }
    }
}
