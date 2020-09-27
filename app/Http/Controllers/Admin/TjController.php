<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tj;
use App\Traits\CreateSlug;
use App\Traits\Vendor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TjController extends Controller
{
    use CreateSlug;
    use Vendor;

    public function index()
    {
        $get_data = Tj::where('vendor_id', $this->vendor_id())->orderBy('id', 'desc')->get();
        return view('admin.network-map.tj')->with(compact('get_data'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tj_name' => 'required',
            'tj_ports' => 'required',
        ]);

        $tj = new Tj();
        $tj->tj_name = $request->tj_name;
        $tj->slug = $this->createSlug('tjs', $request->tj_name);;
        $tj->tj_ports = $request->tj_ports;
        $tj->tj_location = $request->tj_location;
        $tj->notes = $request->notes;
        $tj->vendor_id =  $this->vendor_id();
        $tj->status = ($request->status) ? 1 : 0;
        $store = $tj->save();
        if($store){
            Toastr::success('Tj added successful.');
        }else{
            Toastr::error('TJ cann\'t addedd.');
        }
        return back();
    }


    public function edit($tj)
    {
        $tj = Tj::find($tj);
        return view('admin.network-map.edit.tj')->with(compact('tj'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'tj_name' => 'required',
            'tj_ports' => 'required'
        ]);
        $tj = tj::where('id', $request->id)->first();
        $tj->tj_name = $request->tj_name;
        $tj->tj_ports = $request->tj_ports;
        $tj->tj_location = $request->tj_location;
        $tj->notes = $request->notes;
        $tj->vendor_id =  $this->vendor_id();
        $tj->status = ($request->status) ? 1 : 0;
        $update = $tj->save();
        if($update){
            Toastr::success('TJ update successful.');
        }else{
            Toastr::error('Tj cann\'t update.');
        }
        return back();
    }


    public function delete($id)
    {

        $delete = Tj::where('vendor_id',  $this->vendor_id())->where('id', $id)->delete();

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
