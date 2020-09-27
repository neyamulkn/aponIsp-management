<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

class AdminLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin', ['except' => ['logout']]);
    }


 	public function LoginForm()
    {
      return view('admin.login');
    }

    public function login(Request $request)
    {
      // Validate the form data

      $this->validate($request,[
        'usernameOrEmail' => 'required',
        'password' => 'required',
      ]);

      $fieldType = filter_var($request->usernameOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
      // Attempt to log the admin in
      if(Auth::guard('admin')->attempt(array($fieldType => $request->usernameOrEmail, 'password' => $request->password)))
      {
        Toastr::success('Logged in success.');
        return redirect()->intended(route('admin.dashboard'));
      }
      else {
        Toastr::error( $fieldType. ' or password is invalid.');
        return back()->withInput();
      }
    }

  public function logout()
  {
      Auth::guard('admin')->logout();
      Toastr::success('Just Logged Out!');
      return redirect('/');
    }
  }
