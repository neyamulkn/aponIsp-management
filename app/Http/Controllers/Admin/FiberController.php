<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Core;
use App\Models\Fiber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FiberController extends Controller
{
    //display & add fiber list
    public function index()
    {
        $get_data = Fiber::orderBy('id', 'desc')->get();
        return view('admin.network-map.fiber')->with(compact('get_data'));
    }
    //inert fiber
    public function store(Request $request)
    {
        $request->validate([
            'fiber_name' => 'required',
            'fiber_core' => 'required',
            'core_no' => 'required'
        ]);
        $vendor_id = Auth::user()->vendor_id;
        $data = new Fiber();
        $data->fiber_name = $request->fiber_name;
        $data->fiber_code = $request->fiber_code;
        $data->fiber_core = $request->fiber_core;
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
                $core->type = 'fiber';
                $core->save();
            }
            Toastr::success('Fiber added successful.');
        }else{
            Toastr::error('Fiber cann\'t addedd.');
        }
        return back();
    }
    //edit fiber
    public function edit($fiber)
    {
        $fiber = Fiber::find($fiber);
        return view('admin.network-map.edit.fiber')->with(compact('fiber'));
    }
    //update fiber
    public function update(Request $request)
    {
        $request->validate([
            'fiber_name' => 'required',
            'core_no' => 'required'
        ]);
        $vendor_id = Auth::user()->vendor_id;
        $fiber = Fiber::where('id', $request->id)->first();
        $fiber->fiber_name = $request->fiber_name;
        $fiber->fiber_code = $request->fiber_code;
        $fiber->notes = $request->notes;
        $fiber->vendor_id = $vendor_id;
        $fiber->status = ($request->status) ? 1 : 0;
        $store = $fiber->save();
        if($store){
            foreach ($request->core_no as $key => $color) {
                $core = Core::find($key);
                $core->core_color = $color;
                $core->save();
            }
            Toastr::success('Fiber update successful.');
        }else{
            Toastr::error('Fiber cann\'t update.');
        }
        return back();
    }
    //delete fiber
    public function delete($id)
    {
        $delete = Fiber::where('id', $id)->delete();

        if($delete){
            Core::where('parent_id', $id)->delete();
            $output = [
                'status' => true,
                'msg' => 'Fiber deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Fiber cannot deleted.'
            ];
        }
        return response()->json($output);
    }
    //Show fiber core
    public function showFiberCore($id){
        $fiber = Fiber::with(['fiber_cores.spliter_cores'])->where('id', $id)->first()->toArray();

        if($fiber){
            return view('admin.network-map.modal.core-extend')->with(compact('fiber'));
        }
        return false;
    }
}
