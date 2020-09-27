<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductAttributeController extends Controller
{
    use CreateSlug;

    public function attribute_create()
    {
        $data['get_data'] = ProductAttribute::orderBy('id', 'desc')->get();
        $data['get_category'] = Category::where('parent_id', '=' , null)->orderBy('name', 'asc')->get();

        return view('admin.category.product-attribute')->with($data);
    }


    public function attribute_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);
        $data = new ProductAttribute();
        $data->name = $request->name;
        $data->slug = $this->createSlug('product_attributes', $request->name);
        $data->category_id = $request->category_id;
        $data->display_type = $request->display_type;
        $data->qty = ($request->qty ? 1 : null);
        $data->price = ($request->price ? 1 : null);
        $data->image = ($request->image ? 1 : null);
        $data->color = ($request->color ? 1 : null);
        $data->status = ($request->status ? 1 : 0);
        $data->created_by = Auth::id();
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : Auth::guard('vendor')->id());

        $store = $data->save();
        if($store){
            Toastr::success('Attribute Create Successfully.');
        }else{
            Toastr::error('Attribute Cannot Create.!');
        }
        Session::put('autoSelectId', $request->category_id);
        return back();
    }



    public function attribute_edit($id)
    {
        $data['get_category'] = Category::where('parent_id', '=' , null)->orderBy('name', 'asc')->get();
        $data['data'] = ProductAttribute::find($id);
        echo view('admin.category.edit.product-attribute')->with($data);
    }


    public function attribute_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);
        $data = ProductAttribute::find($request->id);
        $data->name = $request->name;
        $data->category_id = $request->category_id;
        $data->display_type = $request->display_type;
        $data->qty = ($request->qty ? 1 : null);
        $data->price = ($request->price ? 1 : null);
        $data->image = ($request->image ? 1 : null);
        $data->color = ($request->color ? 1 : null);
        $data->status = ($request->status ? 1 : 0);
        $data->updated_by = Auth::id();
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id);

        $store = $data->save();
        if($store){
            Toastr::success('Attribute Update Successfully.');
        }else{
            Toastr::error('Attribute Cannot Update.!');
        }

        return back();
    }


    public function attribute_delete($id)
    {
        $delete = ProductAttribute::where('id', $id)->delete();

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

    public function attributevalue($slug)
    {
        $data['attribute'] = ProductAttribute::where('slug', $slug)->first();
        if( $data['attribute']) {
            $data['get_data'] = ProductAttributeValue::where('attribute_id', $data['attribute']->id)->get();
        }else{
            Toastr::error('Attribute not found.!');
            return back();
        }
        return view('admin.category.product-attributevalue')->with($data);
    }


    public function attributevalue_store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);
        $data = new ProductAttributeValue();
        $data->name = $request->name;
        $data->attribute_id = $request->attribute_id;
        $data->status = ($request->status ? 1 : 0);
        $data->created_by = Auth::id();

        $store = $data->save();
        if($store){
            Toastr::success('Attribute value set successfully.');
        }else{
            Toastr::error('Attribute value cannot create.!');
        }
        Session::put('autoSelectId', $request->attribute_id);
        return back();
    }



    public function attributevalue_edit($id)
    {
        $data['data'] = ProductAttributeValue::find($id);
        echo view('admin.category.edit.product-attributevalue')->with($data);
    }


    public function attributevalue_update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = ProductAttributeValue::find($request->id);
        $data->name = $request->name;
        $data->status = ($request->status ? 1 : 0);
        $data->updated_by = Auth::id();
        $store = $data->save();
        if($store){
            Toastr::success('Attribute value update successfully.');
        }else{
            Toastr::error('Attribute value cannot update.!');
        }

        return back();
    }


    public function attributevalue_delete($id)
    {
        $delete = ProductAttributeValue::where('id', $id)->delete();

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
