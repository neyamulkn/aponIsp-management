<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Designation;
use App\Models\District;
use App\Models\Role;
use App\Staff;
use App\Models\Zone;
use App\Traits\vendor;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminStaffController extends Controller
{
    use vendor;

    public function index()
    {
        $staffs = Staff::with('user:id,name,mobile,email,username,subzone')->orderBy('id', 'asc')->get();
        return view('admin.staff.staff-list')->with(compact('staffs'));
    }

    public function create()
    {
        $data = [];
        $data['districts'] = District::orderBy('name', 'asc')->get();
        $data['zones'] = Zone::where('vendor_id', $this->vendor_id())->where('zone_id', null)->where('status', 1)->orderBy('name', 'asc')->get();
        $data['roles'] = Role::orderBy('id', 'asc')->where('status', 1)->get();
        $data['designations'] = Designation::orderBy('designation', 'asc')->get();
        return view('admin.staff.staff-create')->with($data);
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'designation' => $request->designation,
            'salary' => $request->salary,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'staff_dsc' => $request->user_dsc,
            'zone' => $request->zone,
            'subzone' => $request->subzone,
            'join_date' => $request->join_date,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'vendor_id' => $this->vendor_id(),
            'status' => ($request->status ? 1 : 0)
        ];

        if ($request->hasFile('phato')) {
            $image = $request->file('phato');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image_path = public_path('upload/users/avatars/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(70, 70);
            $image_resize->save($image_path);

            $image->move(public_path('upload/users'), $new_image_name);

            $data = array_merge($data, ['phato' => $new_image_name]);
        }

        try {
            $store = Staff::create($data);

            if ($store) {
                Toastr::success('Staff create successfully.');
            }else {
                Toastr::error('Staff cannot create.!');
                return back()->withInput();
            }
        }catch (\Exception $e){
            Toastr::error('Staff cannot create.!');
            Toastr::error($e->getMessage());
            return back()->withInput();
        }
dd($store);
        return redirect()->back();
    }


    public function update(Request $request, Staff $staff)
    {
        //
    }


    public function delete(Staff $staff)
    {
        //
    }
}
