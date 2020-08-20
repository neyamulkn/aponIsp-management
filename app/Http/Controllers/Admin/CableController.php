<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\cable;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CableController extends Controller
{
    public function index()
    {
        $get_data = Cable::orderBy('id', 'desc')->where('vendor_id', Auth::user()->vendor_id)->get();
        return view('admin.cable')->with(compact('get_data'));
    }



    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'notes' => $request->notes,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Cable::create($data);
        if($store){
            Toastr::success('cable Create Successfully.');
        }else{
            Toastr::error('cable cannot Create.!');
        }

        return back();
    }


    public function edit($id)
    {
        $data = Cable::find($id);
        echo view('admin.edit.edit-form')->with(compact('data'));
    }


    public function update(Request $request, cable $cable)
    {
        $update = Cable::where('id', $request->id)->where('vendor_id', Auth::user()->vendor_id)->update([
            'name' => $request->name,
            'notes' => $request->notes,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status) ? 1 : 0
        ]);
        if($update){
            Toastr::success('cable updated.');
        }else{
            Toastr::error('cable connot updated.');
        }
        return back();
    }


    public function delete($id)
    {
        $delete = Cable::where('id', $id)->where('vendor_id', Auth::user()->vendor_id)->delete();

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
