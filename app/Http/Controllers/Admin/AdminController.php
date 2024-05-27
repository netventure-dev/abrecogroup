<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show()
    {

      $user =Auth::user();
      return view('admin.settings.show',compact('user'));

    }
    public function store(Request $request)

     {

        $user =Auth::user();

        $validated = $request->validate([
            'email' => 'required',
            'name'=>'required',
           ]);

           $user->email = $validated['email'];
           $user->name = $validated['name'];
           $res = $user->save();

           if ($res) {
            notify()->success(__('Profile updated successfully'));
          } else {
            notify()->error(__(' Please try again'));
         }
           return redirect()->back();


     }

}
