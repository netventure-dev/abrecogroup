<?php

namespace App\Http\Controllers;
use App\Models\Rod;
use App\Models\Bundle;
use App\Models\Size;
use App\Models\Gst;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $sizes= Size::where('status',1)->get();
        $gst = Gst::where('status',1)->first();
        return view('home',compact('sizes','gst'));
    }

    public function rod_calc(Request $request)
    {
        $data= Rod::where('size_id',$request->size_val)->first();
        $bundle_data= Bundle::where('size_id',$request->size_val)->first();
        $weight=0;
        $bundle="";
        $rem="";
        $total_weight = "";
        if($request->rod){
            $no_of_rods=$request->rod;
            $weight=$data->weight;
            $total_weight = $weight * $no_of_rods;
            if($bundle_data){
                if($no_of_rods >= $bundle_data->no_of_rods){
                    $bundle = intval($no_of_rods / $bundle_data->no_of_rods);
                    $rem = $no_of_rods % $bundle_data->no_of_rods;
                }
            }
        }
        
        return response()->json(['data' => $data,'total_weight' => $total_weight,'bundle' => $bundle,'rem' => $rem]);  
  
    }
    public function bundle_calc(Request $request)
    {
        $data= Bundle::where('size_id',$request->size_val)->first();
        $weight=0;
        $rod="";
        $total_weight = 0;
        if($request->bundle){
            $no_of_bundles=$request->bundle;
            $weight=$data->weight;
            $total_weight = $weight * $no_of_bundles;
            $rods=$data->no_of_rods * $no_of_bundles;
        }
        
        return response()->json(['data' => $data,'total_weight' => $total_weight,'rods' => $rods]);  
  
    }
    public function weight_calc(Request $request)
    {
        $data= Rod::where('size_id',$request->size_val)->first();
        $bundle_data= Bundle::where('size_id',$request->size_val)->first();
        $bundle="";
        $rods="";
        $rem="";
        if($request->weight){
            $weight=$request->weight;
            if($request->weight > $data->weight){
                $rods = intval($request->weight / $data->weight);
                if($rods >= $bundle_data->no_of_rods){
                    $bundle = intval($rods / $bundle_data->no_of_rods);
                    $rem = $rods % $bundle_data->no_of_rods;

                }
            }
        }
        
        return response()->json(['data' => $data,'bundle' => $bundle,'rods' => $rods,'rem' => $rem]);  
  
    }
    public function rate_calc(Request $request)
    {
        $weight=0;
        $rate=0;
        $total_amount=0;
        if($request->rate){
            $rate=$request->rate;
            $weight=$request->weight;
            $total_amount=round($rate*$weight);
        }
        return response()->json(['total_amount' => $total_amount]);  
  
    }
}
