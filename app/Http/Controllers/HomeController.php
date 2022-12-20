<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $schedules=Schedule::where('status',1)->get();
        return view('home',compact('schedules'));
    }

}
