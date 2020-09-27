<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Core;
use App\Models\ExtendCore;
use App\Models\Fiber;
use App\Models\Spliter;
use App\Traits\vendor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FiberController extends Controller
{
    use Vendor;
    //display & add fiber list
    public function index()
    {
        $get_data = Fiber::where('vendor_id', $this->vendor_id() )
            ->withCount([
                'cores as active_core' => function ($query) {
                    $query->where('core_status', 1);
                },
                'cores as inactive_core' => function ($query) {
                    $query->where('core_status', 0);
                }
            ])
          ->orderBy('id', 'desc')->get();

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
        $data = new Fiber();
        $data->fiber_name = $request->fiber_name;
        $data->fiber_code = $request->fiber_code;
        $data->fiber_core = $request->fiber_core;
        $data->notes = $request->notes;
        $data->vendor_id = $this->vendor_id() ;
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
        $fiber = Fiber::where('id', $request->id)->first();
        $fiber->fiber_name = $request->fiber_name;
        $fiber->fiber_code = $request->fiber_code;
        $fiber->notes = $request->notes;
        $fiber->vendor_id = $this->vendor_id() ;
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

        $delete = Fiber::where('vendor_id', $this->vendor_id() )->where('id', $id)->delete();

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
    //Show fiber core by fiber id
    public function showFiberCore($id){
        $get_cores = Fiber::with(['cores.extend_core'])->where('id', $id)->first();

        if($get_cores){
            return view('admin.network-map.modal.core-extend')->with(compact('get_cores'));
        }
        return false;
    }

    //Show spliter list
    public function getSpliter(Request $request, $extend_core_id){
        $extend_id = $request->parent_id;
        $spliters = Spliter::all();
        $output = '';
        if($spliters){
           $output = view('admin.network-map.spliter-list')->with(compact('spliters', 'extend_id', 'extend_core_id'));
        }
        return $output;
    }
    //extend core by fiber id
    public function extendCore(Request $request)
    {
        $core = Core::find($request->extend_core_id);

        if($core) {
            $core->update(['core_status' => 1]);
            Fiber::where('id', $core->parent_id)->update(['status' => 1]);
            Spliter::where('id', $request->spliter_id)->update(['extend_core_id' => $request->extend_core_id, 'status' => 1]);
        }

        return back();
    }
}
