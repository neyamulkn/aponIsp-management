<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index()
    {
        $vendor_id = Auth::user()->vendor_id;
        $get_data = Brand::orderBy('id', 'desc')->where('vendor_id', $vendor_id)->get();
        return view('admin.brand.brand')->with(compact('get_data'));
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'created_by' => Auth::id(),
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Brand::create($data);
        if($store){
            Toastr::success('Brand Create Successfully.');
        }else{
            Toastr::error('Brand cannot Create.!');
        }

        return back();
    }


    public function edit($id)
    {
        $data = Brand::find($id);
        echo view('admin.brand.edit.brand')->with(compact('data'));
    }


    public function update(Request $request)
    {
        $update = Brand::where('id', $request->id)->update([
            'name' => $request->name,
            'status' => ($request->status) ? 1 : 0
        ]);
        if($update){
            Toastr::success('Brand updated.');
        }else{
            Toastr::error('Brand connot updated.');
        }
        return back();
    }


    public function delete($id)
    {
        $vendor_id = Auth::user()->vendor_id;
        $delete = Brand::where('id', $id)->where('vendor_id', $vendor_id)->delete();

        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Item deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Item cannot deleted.'
            ];
        }
        return response()->json($output);
    }
}
