<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoxController extends Controller
{
    public function index()
    {
        $get_data = Box::orderBy('id', 'desc')->get();
        return view('admin.box')->with(compact('get_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.box');
    }


    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'notes' => $request->notes,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Box::create($data);
        if($store){
            Toastr::success('box Create Successfully.');
        }else{
            Toastr::error('box cannot Create.!');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\box  $box
     * @return \Illuminate\Http\Response
     */
    public function show(box $box)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\box  $box
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Box::find($id);
        echo view('admin.edit.edit-form')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\box  $box
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, box $box)
    {
        $update = Box::where('id', $request->id)->update([
            'name' => $request->name,
            'notes' => $request->notes,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'status' => ($request->status) ? 1 : 0
        ]);
        if($update){
            Toastr::success('box updated.');
        }else{
            Toastr::error('box connot updated.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\box  $box
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $delete = Box::where('id', $id)->delete();

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
