<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Upzilla;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UpzillaController extends Controller
{

    public function index()
    {
        $get_district = District::where('status', 1)->get();
        $get_data = Upzilla::orderBy('id', 'desc')->get();
        return view('admin.upzilla')->with(compact('get_data', 'get_district'));
    }

    public function create()
    {
        return view('admin.upzilla');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'district_id' => $request->district_id,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Upzilla::create($data);
        if($store){
            Toastr::success('Upzilla Create successfully.');
        }else{
            Toastr::error('Upzilla cannot create.!');
        }

        return back();
    }


    public function edit($id)
    {
        $get_district = District::where('status', 1)->get();
        $data = Upzilla::find($id);
        echo view('admin.edit.upzilla')->with(compact('data','get_district'));
    }


    public function update(Request $request)
    {
        $update = Upzilla::where('id', $request->id)->update([
            'name' => $request->name,
            'district_id' => $request->district_id,
            'status' => ($request->status) ? 1 : 0
        ]);
        if($update){
            Toastr::success('Upzilla updated.');
        }else{
            Toastr::error('Upzilla connot updated.');
        }
        return back();
    }


    public function delete($id)
    {
        $delete = Upzilla::where('id', $id)->delete();

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

    public function get_upzilla($id=null){

        $output = '';
        $get_upzilla = Upzilla::where('district_id', $id)->get();
        if(count($get_upzilla)>0){
            $output .= '<option value="">Select upzilla</option>';
            foreach($get_upzilla as $upzilla){
                $output .='<option '. (old("upzilla") == $upzilla->id ? "selected" : "" ).' value="'.$upzilla->id.'">'.$upzilla->name.'</option>';
            }
        }
        echo $output;
    }
}
