<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UserLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
      $input = $request->all();

      $this->validate($request, [
          'usernameOrEmail' => 'required',
          'password' => 'required',
      ]);

      $fieldType = filter_var($request->usernameOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

      if(auth()->attempt(array($fieldType => $input['usernameOrEmail'], 'password' => $input['password'])))
      {
          Cart::where('user_id', Session::get('user_id'))->update(['user_id' => Auth::id()]);
          //check duplicate records
          $duplicateRecords = Cart::select('product_id')
              ->where('user_id', Auth::id())
              ->selectRaw( 'id, count("product_id") as occurences')
              ->groupBy('product_id')
              ->having('occurences', '>', 1)
              ->get();
          //delete duplicate record
          foreach($duplicateRecords as $record) {
              $record->where('id', $record->id)->delete();
          }

          Toastr::success('Logged in success.');
          return back();
      }else{
          Toastr::error( $fieldType. ' or password is invalid.');
          return back()->withInput();
      }
    }

    public function logout() {
      Auth::logout();
      Toastr::success('Just Logged Out!');
      return redirect('/');
    }
}
