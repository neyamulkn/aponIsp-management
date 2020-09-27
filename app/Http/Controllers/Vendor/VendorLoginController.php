<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Vendor;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class VendorLoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:vendor', ['except' => ['logout']]);
    }

    public function loginForm() {
      return view('vendors.login');
    }

    public function login(Request $request) {


      $this->validate($request, [
            'usernameOrEmail' => 'required',
            'password' => 'required',
        ]);

      $fieldType = filter_var($request->usernameOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

      // $vendor = Vendor::where($fieldType, $request->usernameOrEmail)->first();
      // if (!empty($vendor) && ($vendor->status == 0 || $vendor->status == -1)) {
      //     return back()->with('missmatch', 'Username/Password didn\'t match!');
      // }


      if(Auth::guard('vendor')->attempt(array($fieldType => $request->usernameOrEmail, 'password' => $request->password)))
      {
        Toastr::success('Logged in success.');
        return redirect()->intended(route('vendor.dashboard'));
      }
      else {
        Toastr::error( $fieldType. ' or password is invalid.');
        return back()->withInput();
      }
    }

    public function logout() {
      Auth::guard('vendor')->logout();
      Toastr::success('Just Logged Out!');
      return redirect('/');
    }
}
