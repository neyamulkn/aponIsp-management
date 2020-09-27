<?php
namespace App\Traits;


use Illuminate\Support\Facades\Auth;

trait vendor
{
    public function vendor_id(){
        if(Auth::guard('admin')->check()){
            return Auth::guard('admin')->id();
        }elseif(Auth::guard('vendor')->check()){
            return Auth::guard('vendor')->id();
        }elseif(Auth::guard('staff')->check()){
            return Auth::guard('staff')->user()->vendor_id;
        }else{
            return 0;
        }
    }

    public function user_id(){
        if(Auth::guard('admin')->check()){
            return Auth::guard('admin')->id();
        }elseif(Auth::guard('vendor')->check()){
            return Auth::guard('vendor')->id();
        }elseif(Auth::guard('staff')->check()){
            return Auth::guard('staff')->id();
        }else{
            return 0;
        }

    }
}




