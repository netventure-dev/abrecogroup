<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Models\Quote;
use App\Models\Service;
use App\Notifications\QuoteNotification;
use App\Notifications\QuotessNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class RequestQuoteController extends Controller
{
    public function index()
    {
        $services = Service::get();
        return view('request-a-quote.show', compact('services'));
    }
    public function store(Request $request)
    {
        // return 1;
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'service' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'location' => 'required',
                'g-recaptcha-response' => 'required|captcha',

            ],
        );
        //  return 1;
        $request = new Quote();
        $request->name = $validated['name'];
        $request->service = $validated['service'];
        $request->phone = $validated['phone'];
        $request->location = $validated['location'];
        // dd($feedbacks);
        $res = $request->save();
        //  return view('request-a-quote.show');
        if ($res) {
            $admin = Admin::first();
            $details['name'] = $validated['name'];
            $details['service'] = $validated['service'];
            $details['phone'] = $validated['phone'];
            $details['location'] = $validated['location'];
            $details['admin_name'] = $admin->name;
            //  Notification::send($admin, new QuoteNotification($details));
            //  Notification::route('mail', $admin->email)->notify(new QuotessNotification($admin));
            return redirect()->back()->with('Sucess','Sucessfully Contacted');
        } else {
            return redirect()->back()->with('error', 'Failed to contact us. Please try again.');
        }
    }
}
