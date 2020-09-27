<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Traits\vendor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZoneController extends Controller
{
    use vendor;
    public function index()
    {
        $get_data = Zone::where('zone_id', null)->orderBy('id', 'desc')->get();
        return view('admin.zone')->with(compact('get_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.zone');
    }


    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'notes' => $request->notes,
            'vendor_id' => $this->vendor_id(),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Zone::create($data);
        if($store){
            Toastr::success('zone Create Successfully.');
        }else{
            Toastr::error('zone cannot Create.!');
        }

        return back();
    }

    public function edit($id)
    {
        $data = Zone::find($id);
        echo view('admin.edit.edit-form')->with(compact('data'));
    }


    public function update(Request $request, zone $zone)
    {
        $update = Zone::where('id', $request->id)->update([
            'name' => $request->name,
            'notes' => $request->notes,
            'status' => ($request->status) ? 1 : 0
        ]);
        if($update){
            Toastr::success('zone updated.');
        }else{
            Toastr::error('zone connot updated.');
        }
        return back();
    }


    public function delete($id)
    {
        $delete = Zone::where('id', $id)->delete();

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


    // sub zone

    public function subzone_index()
    {
        $get_zone = Zone::where('zone_id', null)->get();
        $get_data = Zone::where('zone_id', '!=', null)->orderBy('id', 'desc')->get();
        return view('admin.subzone')->with(compact('get_data', 'get_zone'));
    }


    public function subzone_create()
    {
        return view('admin.subzone');
    }

    public function subzone_store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'zone_id' => $request->zone_id,
            'notes' => $request->notes,
            'vendor_id' => $this->vendor_id(),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Zone::create($data);
        if($store){
            Toastr::success('Sub zone Create successfully.');
        }else{
            Toastr::error('Sub zone cannot create.!');
        }

        return back();
    }

    public function subzone_edit($id)
    {
        $get_zone = Zone::where('zone_id', null)->get();
        $data = Zone::find($id);
        echo view('admin.edit.subzone')->with(compact('data','get_zone'));
    }


    public function subzone_update(Request $request)
    {
        $update = Zone::where('id', $request->id)->update([
            'name' => $request->name,
            'zone_id' => $request->zone_id,
            'notes' => $request->notes,
            'status' => ($request->status) ? 1 : 0
        ]);
        if($update){
            Toastr::success('Sub zone updated.');
        }else{
            Toastr::error('Sub zone connot updated.');
        }
        return back();
    }


    public function subzone_delete($id)
    {
        $delete = Zone::where('id', $id)->delete();

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

    public function get_subzone($id=null){

        $output = '';
        $get_subzones = Zone::where('zone_id', $id)->get();
        if(count($get_subzones)>0){
            $output .= '<option value="">Select sub zone</option>';
            foreach($get_subzones as $subzone){
                $output .='<option  '.(old("subzone") == $subzone->id ? "selected" : "" ).'  value="'.$subzone->id.'">'.$subzone->name.'</option>';
            }
        }
        echo $output;
    }

}
