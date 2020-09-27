<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PredefinedFeature;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PredefinedFeatureController extends Controller
{

    public function index()
    {
        $data['get_data'] = PredefinedFeature::orderBy('id', 'desc')->get();
        $data['get_category'] = Category::where('parent_id', '=' , null)->orderBy('name', 'asc')->get();

        return view('admin.category.product-feature')->with($data);
    }

    public function store(Request $request)
    {
        $check = PredefinedFeature::where('name', $request->name)->where('vendor_id', Auth::guard('vendor')->id())->first();
        if($check){
            Toastr::error($request->name . ' already exists.!');
            return back()->withInput();
        }
        $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);
        $data = new PredefinedFeature();
        $data->name = $request->name;
        $data->category_id = $request->category_id;

        $data->status = ($request->status ? 1 : 0);
        $data->created_by = Auth::id();
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : Auth::guard('vendor')->id());

        $store = $data->save();
        if($store){
            Toastr::success('Feature added successfully.');
        }else{
            Toastr::error('Feature cannot added.!');
            return back()->withInput();
        }
        Session::put('autoSelectId', $request->category_id);
        return back()->withInput();
    }


    public function edit($id)
    {
        $data['get_category'] = Category::where('parent_id', '=' , null)->orderBy('name', 'asc')->get();
        $data['data'] = PredefinedFeature::find($id);
        echo view('admin.category.edit.product-feature')->with($data);
    }


    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);
        $data = PredefinedFeature::find($request->id);
        $data->name = $request->name;
        $data->category_id = $request->category_id;

        $data->status = ($request->status ? 1 : 0);
        $data->created_by = Auth::id();
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : Auth::guard('vendor')->id());

        $store = $data->save();
        if($store){
            Toastr::success('Feature update successfully.');
            return back();
        }else{
            Toastr::error('Feature cannot update.!');
            return back()->withInput();
        }

    }


    public function delete($id)
    {
        $delete = PredefinedFeature::where('id', $id)->delete();

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
