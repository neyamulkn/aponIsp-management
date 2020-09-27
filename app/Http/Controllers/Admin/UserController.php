<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Cable;
use App\Models\Customers;
use App\Models\District;
use App\Models\Package;
use App\Models\Role;
use App\Staff;
use App\Models\Upzilla;
use App\Models\Zone;
use App\Traits\vendor;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    use Vendor;

    public function index(){
        $users = Customers::with('user:id,name,mobile,email,username,subzone')
            ->where('vendor_id', $this->vendor_id())
            ->orderBy('id', 'desc')->get();
        return view('admin.user-list')->with(compact('users'));
    }
    public function create(){
        $data = [];
        $data['packages'] = Package::orderBy('pkg_name', 'asc')->get();
        $data['districts'] = District::orderBy('name', 'asc')->get();
        $data['zones'] = Zone::where('zone_id', null)->orderBy('name', 'asc')->get();
        $data['boxes'] = Box::orderBy('name', 'asc')->get();
        $data['cables'] = Cable::orderBy('name', 'asc')->get();
        $data['staffs'] = Staff::with('user:id,name')->orderBy('id', 'asc')->get();
        $data['roles'] = Role::orderBy('id', 'asc')->get();
    	return view('admin.user-create')->with($data);
    }

    public function store(Request $request)
    {
            $request->validate([
                'name' => 'required',
                'mobile' => 'required|unique:users',
                'email' => 'required|unique:users',
                'package_id' => 'required',
                'bandwidth' => 'required',
                'amount' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required',
                'phato' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

        $data = [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'road_no' => $request->road_no,
                'house_no' => $request->house_no,
                'flat_no' => $request->flat_no,
                'user_dsc' => $request->user_dsc,
                'district' => $request->district,
                'upzilla' => $request->upzilla,
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
            $store = User::create($data);
            if ($store) {

                $customer = [
                    'user_id' => $store->id,
                    'package_id' => $request->package_id,
                    'amount' => $request->amount,
                    'bandwidth' => $request->bandwidth,
                    'allowcated_ip' => $request->allowcated_ip,
                    'mac' => $request->mac,
                    'location_point' => $request->location_point,
                    'connection_type' => $request->connection_type,
                    'connectivity_type' => $request->connectivity_type,
                    'discount' => $request->discount,
                    'comment' => $request->comment,
                    'box_id' => $request->box_id,
                    'cable_id' => $request->cable_id,
                    'reseller_id' => $request->reseller_id,
                    'marketing_by' => $request->marketing_by,
                    'setup_by' => $request->setup_by,
                    'ref_by' => $request->ref_by,
                    'vendor_id' => $this->vendor_id(),
                    'status' => ($request->status ? 1 : 0)
                ];

                $insert = Customers::create($customer);
                if($insert) {
                    Toastr::success('User create successfully.');
                }
            }else {
                Toastr::error('User cannot create.!');
                return back()->withInput();
            }
        }catch (\Exception $e){
            Toastr::error('User cannot create.!');
            Toastr::error($e->getMessage());
            return back()->withInput();
        }

        return back();
    }

    public function active_user(){
        $users = Customers::where('vendor_id', $this->vendor_id())->where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.user-active')->with(compact('users'));
    }

    public function inactive_user(){
        $users = Customers::where('vendor_id', $this->vendor_id())->where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.user-inactive')->with(compact('users'));
    }

    public function block_user(){
        $users = Customers::where('vendor_id', $this->vendor_id())->where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.user-inactive')->with(compact('users'));
    }

    public function download_user(){
        $users = Customers::where('vendor_id', $this->vendor_id())->orderBy('id', 'desc')->get();
        return view('admin.user-download')->with(compact('users'));
    }

    public function user_profile($username){
        $user = User::where('username', $username)->first();

        return view('admin.profile')->with(compact('user'));
    }
}
