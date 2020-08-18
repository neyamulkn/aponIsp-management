<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayMethod;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PayMethodController extends Controller
{
    public function index()
    {
        $get_data = PayMethod::orderBy('id', 'desc')->get();
        return view('admin.pay-method')->with(compact('get_data'));
    }


    public function create()
    {
        return view('admin.cable');
    }


    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = PayMethod::create($data);
        if($store){
            Toastr::success('Method Create Successfully.');
        }else{
            Toastr::error('Method cannot Create.!');
        }

        return back();
    }


    public function show(cable $cable)
    {
        //
    }


    public function edit($id)
    {
        $data = PayMethod::find($id);
        echo view('admin.edit.edit-form')->with(compact('data'));
    }


    public function update(Request $request)
    {
        $update = PayMethod::where('id', $request->id)->update([
            'name' => $request->name,
            'status' => ($request->status) ? 1 : 0
        ]);
        if($update){
            Toastr::success('Method updated.');
        }else{
            Toastr::error('Method connot updated.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cable  $cable
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $delete = PayMethod::where('id', $id)->delete();

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
