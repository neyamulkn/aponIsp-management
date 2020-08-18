<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_data = Designation::orderBy('id', 'desc')->get();
        return view('admin.designation')->with(compact('get_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.designation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'designation' => $request->designation,
            'notes' => $request->notes,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Designation::create($data);
        if($store){
            Toastr::success('Designation Create Successfully.');
        }else{
            Toastr::error('Designation cannot Create.!');
        }

        return back();
    }


    public function edit($id)
    {
        $data = Designation::find($id);
        echo view('admin.edit.designation')->with(compact('data'));
    }


    public function update(Request $request)
    {
        $data = [
            'designation' => $request->designation,
            'notes' => $request->notes,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Designation::where('id', $request->id)->update($data);
        if($store){
            Toastr::success('Designation update Successfully.');
        }else{
            Toastr::error('Designation cannot update.!');
        }

        return back();
    }


    public function delete($id)
    {
        $delete = Designation::where('id', $id)->delete();

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
