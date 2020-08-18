<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Stock;
use App\Models\StockCategory;
use App\Models\Brand;
use App\Models\Staff;
use App\Models\StockOut;
use App\Models\StockShop;
use App\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor_id = Auth::user()->vendor_id;
        $data['get_stocks'] = Stock::where('vendor_id', $vendor_id)->get();
        $data['get_category'] = StockCategory::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['get_brand'] = Brand::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['shops'] = StockShop::where('vendor_id', $vendor_id)->where('status', 1)->orderBy('id', 'asc')->get();
        return view('admin.stock.stock')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'shop_id' => $request->shop_id,
            'brand_id' => $request->brand_id,
            'code' => $request->product_code,
            'serial' => $request->serial,
            'model' => $request->model,
            'mac' => $request->mac,
            'port' => $request->port,
            'quantity' => $request->qty,
            'available' => $request->qty,
            'warranty' => $request->warranty,
            'price' => $request->price,
            'date' => $request->stock_date,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'created_by' => Auth::id(),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = Stock::create($data);
        if($store){
            Toastr::success('Stock create successfully.');
        }else{
            Toastr::error('Stock cannot create.!');
        }

        return back();
    }



    public function edit($id)
    {
        $vendor_id = Auth::user()->vendor_id;
        $data['data'] = Stock::where('vendor_id', $vendor_id)->where('id', $id)->first();
        $data['get_category'] = StockCategory::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['get_brand'] = Brand::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['shops'] = StockShop::where('vendor_id', $vendor_id)->get();
        echo view('admin.stock.edit.stock')->with($data);

    }


    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required|numeric',
        ]);

        $stock = Stock::where('vendor_id', Auth::user()->vendor_id)->where('id', $request->id)->first();
        if($stock) {
            $data = [
                'name' => $request->name,
                'category_id' => $request->category_id,
                'shop_id' => $request->shop_id,
                'brand_id' => $request->brand_id,
                'code' => $request->product_code,
                'serial' => $request->serial,
                'model' => $request->model,
                'mac' => $request->mac,
                'port' => $request->port,
                'quantity' => $request->qty,
                'available' => $request->qty - $stock->available,
                'warranty' => $request->warranty,
                'price' => $request->price,
                'date' => $request->stock_date,
                'updated_by' => Auth::id(),
                'status' => ($request->status ? 1 : 0)
            ];

            $update = $stock->update($data);
            if ($update) {
                Toastr::success('Stock update successfully.');
            } else {
                Toastr::error('Stock cannot update.!');
            }
        }

        return back();
    }

    public function delete($id)
    {
        $delete = Stock::where('vendor_id', Auth::user()->vendor_id)->where('id', $id)->delete();

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
    // stock out type user, box etc
    public  function stockOutType(Request $request){
        $data['type'] = $request->type;
        $data['stockOutBy'] = null;
        if($request->type == 'user'){
            $data['stockOutBy'] = User::where('vendor_id', Auth::user()->vendor_id)->where('role_id', 4)->get();
        }elseif($request->type == 'box'){
            $data['stockOutBy']  = Box::where('vendor_id', Auth::user()->vendor_id)->get();
        }elseif($request->type == 'tg'){

        }else{
            echo '';
        }
        if($data['stockOutBy']){
            return view('admin.stock.stockOutBy')->with($data);
        }
        return false;
    }

    public function stockOut(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric',
            'price' => 'required',
        ]);

        $stockOut = Stock::where('id', $request->stock_id)->where('vendor_id', Auth::user()->vendor_id)->first();
        if($stockOut){
            $data = [
                'stock_id' => $request->stock_id,
                'type' => $request->type,
                'stock_out_by' => $request->stock_out_by,
                'available' => $stockOut->available,
                'quantity' => $request->qty,
                'price' => $request->price,
                'date' => $request->stock_date,
                'notes' => $request->notes,
                'created_by' => Auth::id(),
                'status' => 'Running',
            ];
            $store = StockOut::create($data);
            if($store){
                $stockOut->decrement('available', $request->qty);
                Toastr::success('Stock out successfully.');
            }else{
                Toastr::error('Stock cannot out.!');
            }
        }else{
            Toastr::error('Stock cannot out.!');
        }

        return back();
    }

    public  function stockOutDetails($stock_id){

        $get_data = StockOut::where('stock_id', $stock_id);
        if(Auth::user()->role_id != 1){
            $get_data->where('vendor_id', Auth::user()->vendor_id);
        }
        $get_data = $get_data->get();
        return view('admin.stock.stockOut_details')->with(compact('get_data', 'stock_id'));
    }

    // stock category
    public function stockCategory_index(){
        $get_data = StockCategory::all();
        return view('admin.stock.stock_category')->with(compact('get_data'));

    }

    public function stockCategory_store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'notes' => $request->notes,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'created_by' => Auth::id(),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = StockCategory::create($data);
        if($store){
            Toastr::success('Stock category Create Successfully.');
        }else{
            Toastr::error('Stock category cannot Create.!');
        }

        return back();
    }


    public function stockCategory_edit($id)
    {
        $data = StockCategory::find($id);
        echo view('admin.stock.edit.stock_category')->with(compact('data'));
    }


    public function stockCategory_update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $update = StockCategory::where('id', $request->id)->update([
            'name' => $request->name,
            'notes' => $request->notes,
            'status' => ($request->status) ? 1 : 0
        ]);
        if($update){
            Toastr::success('Stock category updated.');
        }else{
            Toastr::error('Stock category connot updated.');
        }
        return back();
    }


    public function stockCategory_delete($id)
    {
        $delete = StockCategory::where('id', $id)->delete();

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
    //stock Shop
    public function stockShop_index(){
        $get_data = StockShop::all();
        return view('admin.stock.stockShop')->with(compact('get_data'));

    }

    public function stockShop_store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'created_by' => Auth::id(),
            'status' => ($request->status ? 1 : 0)
        ];
        $store = StockShop::create($data);
        if($store){
            Toastr::success('Stock shop create Successfully.');
        }else{
            Toastr::error('Stock category cannot Create.!');
        }

        return back();
    }


    public function stockShop_edit($id)
    {
        $data = StockShop::find($id);
        echo view('admin.stock.edit.stockShop')->with(compact('data'));
    }


    public function stockShop_update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $update = StockShop::where('id', $request->id)->update([
            'name' => $request->name,
            'notes' => $request->notes,
            'status' => ($request->status) ? 1 : 0
        ]);
        if($update){
            Toastr::success('Stock shop updated.');
        }else{
            Toastr::error('Stock shop connot updated.');
        }
        return back();
    }


    public function stockShop_delete($id)
    {
        $delete = StockShop::where('id', $id)->delete();

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
