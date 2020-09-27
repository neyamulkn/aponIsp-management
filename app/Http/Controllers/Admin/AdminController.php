<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Package;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
	public function dashboard()
    {
        $data['total_users'] = Customers::count();
        $data['active_users'] = Customers::where('status', 1)->count();
        $data['inactive_users'] = Customers::where('status', 0)->count();
        $data['packages'] = Package::where('status', 1)->count();
        return view('admin.dashboard')->with($data);

    }
}
