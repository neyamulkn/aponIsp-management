<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Fiber;
use App\Models\Tj;
use App\Models\TjConnection;
use App\Staff;
use App\Traits\vendor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class TjConnectionController extends Controller
{
    use Vendor;

    public function tjConnection($slug)
    {
        $data['get_tj'] = Tj::where('slug', $slug)->first();
        $data['TjConnections'] = TjConnection::with(['get_fiber_start.cores','get_fiber_out.cores', 'get_spliter_start.cores', 'get_spliter_out.cores'])
            ->where('tj_id', $data['get_tj']->id)->get();

        $data['alltj'] = Tj::where('vendor_id',  $this->vendor_id())->where('id', '!=', $data['get_tj']->id)->get();
        $data['fibers'] = Fiber::where('vendor_id',  $this->vendor_id())->get();
        $data['users'] = User::where('vendor_id',  $this->vendor_id())->get();
        $data['boxs'] = Box::where('vendor_id',  $this->vendor_id())->get();
        $data['staffs'] = Staff::where('vendor_id',  $this->vendor_id())->get();

        return view('admin.network-map.tj-connection')->with($data);
    }


    public function tjConnectionStore (Request $request, $tj_id)
    {

        if($request->TjConnection_id){
            $tjconnect = TjConnection::find($request->TjConnection_id);
        }else{
            $tjconnect = new TjConnection();
        }
        $tjconnect->vendor_id = $this->vendor_id();
        $tjconnect->tj_id = $tj_id;
        $tjconnect->fiber_start = $request->fiber_start;
        $tjconnect->core_start = $request->core_start;
        $tjconnect->extend_spliter_start = ($request->extend_spliter_start) ? $request->extend_spliter_start : null;
        $tjconnect->extend_spliter_core_start = ($request->extend_spliter_core_start) ? $request->extend_spliter_core_start : null;
        $tjconnect->fiber_miter_start = $request->fiber_miter_start;
        $tjconnect->details_start = $request->details_start;

       $tjconnect->connectBy = $request->connectBy;
       $tjconnect->connect_type = $request->connect_type;
       $tjconnect->fiber_out = $request->fiber_out;
       $tjconnect->core_out = $request->core_out;
       $tjconnect->extend_spliter_out = ($request->extend_spliter_out) ? $request->extend_spliter_out : null;
       $tjconnect->extend_spliter_core_out = ($request->extend_spliter_core_out) ? $request->extend_spliter_core_out : null;
       $tjconnect->fiber_miter_out = $request->fiber_miter_out;
       $tjconnect->join_tj = ($request->join_tj) ? $request->join_tj : null;
       $tjconnect->details_out = $request->details_out;
       $tjconnect->onu_mac = ($request->onu_mac) ? $request->onu_mac : null;
       $tjconnect->box = ($request->box) ? $request->box : null;
       $tjconnect->user = ($request->user) ? $request->user : null;
       $tjconnect->created_by = $this->user_id();
       $tjconnect->save();

       return back();
    }



    public function edit(TjConnection $tjConnection)
    {
        //
    }

    public function update(Request $request, TjConnection $tjConnection)
    {
        //
    }

    public function delete($tj_id)
    {
        $delete = TjConnection::where('vendor_id', $this->vendor_id())->where('id', $tj_id)->delete();
        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Tj deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Tj cannot deleted.'
            ];
        }
        return response()->json($output);
    }
}
