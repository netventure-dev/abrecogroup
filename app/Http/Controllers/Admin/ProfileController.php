<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
      return redirect()->route('admin.settings.show');
    }

    public function update(Request $request)

    {

            $user =Auth::user();
             $validated = $request->validate([
           'password' => 'required|string|min:4|confirmed',
           ]);
             $user->password = Hash::make($validated['password']);
             $res = $user->save();
             if ($res) {
             notify()->success(__('Password is updated successfully'));
              } else {
              notify()->error(__(' Please try again'));
            }
                  return redirect()->back();


 }


}
