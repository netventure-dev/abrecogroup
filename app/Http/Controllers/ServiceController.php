<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Models\Quote;
use App\Models\Service;
use App\Notifications\QuoteNotification;
use App\Notifications\QuotessNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\ServiceContent;
use App\Models\ServiceContentList;
use App\Models\ServiceFaq;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Models\Seo;


class ServiceController extends Controller
{
    use SEOToolsTrait;

    public function index($slug)
    {
        $service = Service::where('slug', $slug)->where('status', 1)->first();
        if ($service) {
            $content = ServiceContent::where('status',1)->get();
            //  dd($content);
            $faqs = ServiceFaq::where('service_id', $service->uuid)->get();
            $seo = Seo::where('route_name', $slug)->first();
            if ($seo) {
                $this->seo()->setTitle(@$seo->seo_title);
                $this->seo()->setDescription(@$seo->seo_description);
                SEOMeta::setKeywords([@$seo->seo_keywords]);
                $this->seo()->opengraph()->setTitle(@$seo->seo_title);
                $this->seo()->opengraph()->setDescription(@$seo->seo_description);
                $this->seo()->twitter()->setTitle(@$seo->seo_title);
                $this->seo()->twitter()->setDescription(@$seo->seo_description);
            } elseif ($service->seo_title) {
                $this->seo()->setTitle(@$service->seo_title);
                $this->seo()->setDescription(@$service->seo_description);
                SEOMeta::setKeywords([@$service->seo_keywords]);
                $this->seo()->opengraph()->setTitle(@$service->seo_title);
                $this->seo()->opengraph()->setDescription(@$service->seo_description);
                $this->seo()->twitter()->setTitle(@$service->seo_title);
                $this->seo()->twitter()->setDescription(@$service->seo_description);
            }
            return view('service', with(['service' => $service, 'content' => $content, 'faqs' => $faqs]));
        } else {
            abort(404);
        }
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
            return redirect('thank-you')->with('status','1');
        } else {
            return Redirect::to(URL::previous() . "#request_a_quote")->with('error', 'Failed to contact us. Please try again.');
        }
    }
}
