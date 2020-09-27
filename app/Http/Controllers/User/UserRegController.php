<?php

namespace App\Http\Controllers\User;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserRegController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function RegisterForm() {
      return view('user.register');
    }

    public function register(Request $request) {
        return $request->all();

        $gs = GeneralSetting::first();
        if ($gs->registration == 0) {
          Session::flash('alert', 'Registration is closed by Admin');
          return back();
        }

        $validatedRequest = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request['password']);
        $user->email_verified = $gs->email_verification;
        $user->sms_verified = $gs->sms_verification;
        $user->email_ver_code = $gs->email_verification == 0? rand(1000, 9999):NULL;
        $user->sms_ver_code = $gs->sms_verification == 0?rand(1000, 9999):NULL;

        $user->save();

        if (Auth::attempt([ 'username' => $request->username, 'password' => $request->password, ]))
        {
          return redirect()->back();
        }
    }
}
