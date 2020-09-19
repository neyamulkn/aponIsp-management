<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Core;
use App\Models\Spliter;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpliterController extends Controller
{
    //display & add Spliter list
    public function index()
    {
        $get_data = Spliter::orderBy('id', 'desc')->get();
        return view('admin.network-map.spliter')->with(compact('get_data'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'spliter_name' => 'required',
            'spliter_core' => 'required',
            'core_no' => 'required'
        ]);
        $vendor_id = Auth::user()->vendor_id;
        $data = new Spliter();
        $data->spliter_name = $request->spliter_name;
        $data->spliter_core = $request->spliter_core;
        $data->notes = $request->notes;
        $data->vendor_id = $vendor_id;
        $data->status = ($request->status) ? 1 : 0;
        $store = $data->save();
        if($store){
            foreach ($request->core_no as $key => $color) {
                $core = new Core();
                $core->parent_id = $data->id;
                $core->core_no = $key;
                $core->core_color = $color;
                $core->type = 'spliter';
                $core->save();
            }
            Toastr::success('Spliter added successful.');
        }else{
            Toastr::error('Spliter cann\'t addedd.');
        }
        return back();
    }


    public function edit($spliter)
    {
        $spliter = Spliter::find($spliter);
        return view('admin.network-map.edit.Spliter')->with(compact('spliter'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'spliter_name' => 'required',
            'core_no' => 'required'
        ]);
        $vendor_id = Auth::user()->vendor_id;
        $Spliter = Spliter::where('id', $request->id)->first();
        $Spliter->spliter_name = $request->spliter_name;
        $Spliter->notes = $request->notes;
        $Spliter->vendor_id = $vendor_id;
        $Spliter->status = ($request->status) ? 1 : 0;
        $store = $Spliter->save();
        if($store){
            foreach ($request->core_no as $key => $color) {
                $core = Core::find($key);
                $core->core_color = $color;
                $core->save();
            }
            Toastr::success('Spliter update successful.');
        }else{
            Toastr::error('Spliter cann\'t update.');
        }
        return back();
    }


    public function delete($id)
    {
        $delete = Spliter::where('id', $id)->delete();

        if($delete){
            Core::where('parent_id', $id)->delete();
            $output = [
                'status' => true,
                'msg' => 'Spliter deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Spliter cannot deleted.'
            ];
        }
        return response()->json($output);
    }
}
