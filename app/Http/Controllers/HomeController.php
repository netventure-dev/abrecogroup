<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
        return view('home');
    }

}
