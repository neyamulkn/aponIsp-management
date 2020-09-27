<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
class DesignationController extends Controller
{
    //display all designation list
    public function index()
    {
        $get_data = Designation::orderBy('id', 'desc')->get();
        return view('admin.staff.designation')->with(compact('get_data'));
    }

    //store designation
    public function store(Request $request)
    {
        $data = [
            'designation' => $request->designation,
            'notes' => $request->notes,
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

    //edit designation
    public function edit($id)
    {
        $data = Designation::find($id);
        echo view('admin.staff.edit.designation')->with(compact('data'));
    }


    public function update(Request $request)
    {
        $data = [
            'designation' => $request->designation,
            'notes' => $request->notes,
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
