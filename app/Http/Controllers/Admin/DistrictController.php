<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_data = District::orderBy('id', 'desc')->get();
        return view('admin.district')->with(compact('get_data'));
    }


    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = District::create($data);
        if($store){
            Toastr::success('District Create Successfully.');
        }else{
            Toastr::error('District cannot Create.!');
        }

        return back();
    }

    public function edit($id)
    {
        $data = District::find($id);
        echo view('admin.edit.edit-form')->with(compact('data'));
    }


    public function update(Request $request, District $district)
    {
       $update = District::where('id', $request->id)->update([
           'name' => $request->name,
           'status' => ($request->status) ? 1 : 0
       ]);
       if($update){
           Toastr::success('District updated.');
       }else{
           Toastr::error('District connot updated.');
       }
       return back();
    }

    public function delete($id)
    {
        $delete = District::where('id', $id)->delete();

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
