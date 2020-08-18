<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function GuzzleHttp\Psr7\str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_data = Role::orderBy('id', 'asc')->get();
        return view('admin.role')->with(compact('get_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $get_data = Role::orderBy('id', 'asc')->get();

        return view('admin.role')->with(compact('get_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = [
            'name' => $request->name,
            'notes' => $request->notes,
            'slug' => str::slug($request->name),
            'status' => ($request->status ? 1 : 0)
        ];

        $store = Role::create($data);
        if($store){
            Toastr::success('Role created successfully.');
        }else{
            Toastr::error('Role connot created.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Role::find($id);
        echo view('admin.edit.edit-form')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = [
            'name' => $request->name,
            'notes' => $request->notes,
            'status' => ($request->status ? 1 : 0)
        ];

        $update = Role::where('id', $request->id)->update($data);
        if($update){
            Toastr::success('Role update successfully.');
        }else{
            Toastr::error('Role connot update.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $delete = Role::where('id', $id)->delete();

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
