<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Models\News;

class TestimonialsController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

    public function index()
    {
        $data['testimonials'] = Testimonial::select('uuid', 'title', 'description', 'image')->where('status', 1)->get();
        // foreach ($data['testimonials'] as $contact) {
        //     if (empty($contact->image)) {
        //         $contact->image = null;
        //     }
        // }
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function news ()
    {
        $data['news'] = News::select('uuid', 'title', 'description', 'image','slug')->where('status', 1)->get();
       
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
    
}
