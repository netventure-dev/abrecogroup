<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Models\Quote;
use App\Models\Service;
use App\Notifications\QuoteNotification;
use App\Notifications\QuotessNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class RequestQuoteController extends Controller
{
    public function index()
    {
        $services = Service::get();
        return view('request-a-quote.show', compact('services'));
    }
    public function store(Request $request)
    {

        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'service' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'location' => 'required',
                'g-recaptcha-response' => 'required|captcha',

            ],
        );
        $request = new Quote();
        $request->name = $validated['name'];
        $request->service = $validated['service'];
        $request->phone = $validated['phone'];
        $request->location = $validated['location'];
        // dd($feedbacks);
        $res = $request->save();
        //  return view('request-a-quote.show'); 
        
        if($res) {
            $service=Service::where('uuid',$validated['service'])->first();

            $admin = Admin::first();
            $details['name'] = $validated['name'];
            $details['service'] = $service->name;
            $details['phone'] = $validated['phone'];
            $details['email'] = $validated['email'];
            $details['location'] = $validated['location'];
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new QuoteNotification($details));
            Notification::route('mail', $details['email'])->notify(new QuotessNotification($details));
            return Redirect::to(URL::previous() . "#request_a_quote")->with('success', 'Requested Successfully.');
        } else {
            return Redirect::to(URL::previous() . "#request_a_quote")->with('error', 'Failed to contact us. Please try again.');
        }
    }
    public function request_store(Request $request)
    {

        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'service' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'location' => 'required',
                'g-recaptcha-response' => 'required|captcha',

            ],
        );
        $request = new Quote();
        $request->name = $validated['name'];
        $request->service = $validated['service'];
        $request->phone = $validated['phone'];
        $request->location = $validated['location'];
        // dd($feedbacks);
        $res = $request->save();
        //  return view('request-a-quote.show'); 
        
        if($res) {
            $service=Service::where('uuid',$validated['service'])->first();
            $admin = Admin::first();
            $details['name'] = $validated['name'];
            $details['service'] =  $service->name;
            $details['phone'] = $validated['phone'];
            $details['email'] = $validated['email'];
            $details['location'] = $validated['location'];
            $details['admin_name'] = $admin->name;
             Notification::send($admin, new QuoteNotification($details));
             Notification::route('mail', $details['email'])->notify(new QuotessNotification($details));
            return Redirect::to(URL::previous() . "#request_a_quote_data")->with('success-data', 'Requested Successfully.');
        } else {
            return Redirect::to(URL::previous() . "#request_a_quote_data")->with('error-data', 'Failed to contact us. Please try again.');
        }
    }
}
