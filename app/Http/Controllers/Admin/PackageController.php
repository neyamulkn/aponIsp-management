<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_data = Package::orderBy('id', 'desc')->where('vendor_id', Auth::user()->vendor_id)->get();
        return view('admin.package-list')->with(compact('get_data'));
    }

    public function create()
    {
        return view('admin.package');
    }


    public function store(Request $request)
    {
        $request->validate([
            'pkg_name' => 'required',
            'bandwidth' => 'required',
            'price' => 'required',
        ]);
        $data = [
            'pkg_name' => $request->pkg_name,
            'bandwidth' => $request->bandwidth,
            'price' => $request->price,
            'discount' => $request->discount,
            'details' => $request->details,
            'connection_type' => $request->connection_type,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Package::create($data);
        if($store){
            Toastr::success('Package Create Successfully.');
        }else{
            Toastr::error('Package cannot Create.!');
        }

        return back();
    }


    public function edit($id)
    {
        $data = Package::find($id);
        return view('admin.package_edit')->with(compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'pkg_name' => 'required',
            'bandwidth' => 'required',
            'price' => 'required',
        ]);
        $data = [
            'pkg_name' => $request->pkg_name,
            'bandwidth' => $request->bandwidth,
            'price' => $request->price,
            'discount' => $request->discount,
            'details' => $request->details,
            'connection_type' => $request->connection_type,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Package::where('id', $id)->where('vendor_id', Auth::user()->vendor_id)->update($data);
        if($store){
            Toastr::success('Package updated successfully.');
        }else{
            Toastr::error('Package cannot update.!');
        }

        return back();
    }

    public function package_details($id=null){

        $get_package = Package::find($id);
        $output = [
            'status' => false,
        ];
        if($get_package){
            $output = [
                'status' => true,
                'bandwidth' => $get_package->bandwidth,
                'amount' => $get_package->price
            ];
        }

        return response()->json($output);
    }
}
