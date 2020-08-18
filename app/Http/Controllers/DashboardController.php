<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Package;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){

        if(Auth::user()->role_id == 1){
            $data['total_users'] = Customers::count();
            $data['active_users'] = Customers::where('status', 1)->count();
            $data['inactive_users'] = Customers::where('status', 0)->count();
            $data['packages'] = Package::where('status', 1)->count();
            return view('admin.dashboard')->with($data);

        }elseif(Auth::user()->role_id == 2){

            $data['total_users'] = User::count();
            $data['active_users'] = User::where('status', 1)->count();
            $data['inactive_users'] = User::where('status', 0)->count();
            $data['packages'] = Package::where('status', 1)->count();
            return view('users.dashboard')->with($data);

        }elseif(Auth::user()->role_id == 3){

            $data['total_users'] = User::count();
            $data['active_users'] = User::where('status', 1)->count();
            $data['inactive_users'] = User::where('status', 0)->count();
            $data['packages'] = Package::where('status', 1)->count();
            return view('staffs.dashboard')->with($data);

        }else{
            return redirect()->route('404');
        }

    }


}
