<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Stock;
use App\Models\StockCategory;
use App\Models\Brand;
use App\Models\Staff;
use App\Models\StockOut;
use App\Models\StockPayment;
use App\Models\StockShop;
use App\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    //view stock
    public function index(Request $request)
    {
        $vendor_id = Auth::user()->vendor_id;
        $get_stocks = Stock::where('vendor_id', $vendor_id);
        if($request->q){
            $get_stocks->where('name', $request->q);
        }if($request->category){
            $get_stocks->where('category_id', $request->category);
        }
        $data['totalAmount'] = $get_stocks->sum('price');
        $data['totalQty'] = $get_stocks->sum('quantity');
        $data['availableQty'] = $get_stocks->sum('available');

        $data['get_stocks'] = $get_stocks->paginate(15);
        $data['get_category'] = StockCategory::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['get_brand'] = Brand::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['shops'] = StockShop::where('vendor_id', $vendor_id)->where('status', 1)->orderBy('id', 'asc')->get();
        return view('admin.stock.stock')->with($data);
    }
    //add stock
    public function create(){
        $vendor_id = Auth::user()->vendor_id;
        $data['get_category'] = StockCategory::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['get_brand'] = Brand::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['shops'] = StockShop::where('vendor_id', $vendor_id)->where('status', 1)->orderBy('id', 'asc')->get();
        return view('admin.stock.stock-add')->with($data);
    }
    //insert stock
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        $invoice = ($request->invoice) ? $request->invoice : strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), -6));
        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'shop_id' => $request->shop_id,
            'brand_id' => $request->brand_id,
            'invoice' => $invoice,
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
            'notes' => $request->notes,
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'created_by' => Auth::id(),
            'status' => 'stock'
        ];
        $store = Stock::create($data);
        if($store){
            //insert invoice for purchase due display in payment history
            $purchaseDue = StockPayment::where('invoice', $invoice)->where('shop_id', $request->shop_id)->first();
            if(!$purchaseDue){
                StockPayment::create(['vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
                    'invoice' => $invoice,
                    'shop_id' => $request->shop_id, 'payment_by' => Auth::id(),
                    'payment_date' => $request->stock_date
                ]);
            }
            Toastr::success('Stock create successfully.');
        }else{
            Toastr::error('Stock cannot create.!');
        }

        return back();
    }
    // edit stock
    public function edit($id)
    {
        $vendor_id = Auth::user()->vendor_id;
        $data['data'] = Stock::where('vendor_id', $vendor_id)->where('id', $id)->first();
        $data['get_category'] = StockCategory::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['get_brand'] = Brand::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['shops'] = StockShop::where('vendor_id', $vendor_id)->get();
        echo view('admin.stock.edit.stock')->with($data);
    }
    //update stock
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
                'invoice' => $request->invoice,
                'code' => $request->product_code,
                'serial' => $request->serial,
                'model' => $request->model,
                'mac' => $request->mac,
                'port' => $request->port,
                'quantity' => $request->qty,

                'warranty' => $request->warranty,
                'price' => $request->price,
                'date' => $request->stock_date,
                'notes' => $request->notes,
                'updated_by' => Auth::id(),
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
    //delete stock
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

    // stock category
    public function stockCategory_index(){
        $vendor_id = Auth::user()->vendor_id;
        $data['get_data'] = StockCategory::with('get_stocks')->where('vendor_id', $vendor_id)->get();
        $data['get_category'] = StockCategory::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['get_brand'] = Brand::where('vendor_id', $vendor_id)->where('status', 1)->get();
        $data['shops'] = StockShop::where('vendor_id', $vendor_id)->where('status', 1)->orderBy('id', 'asc')->get();

        return view('admin.stock.stock_category')->with($data);

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
        $vendor_id = Auth::user()->vendor_id;
        $data = StockCategory::where('id', $id)->where('vendor_id', $vendor_id)->first();
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
        $vendor_id = Auth::user()->vendor_id;
        $get_data = StockShop::with(['get_stock:shop_id,price', 'get_payment:shop_id,amount'])->where('vendor_id', $vendor_id)->get();
        return view('admin.stock.stockShop')->with(compact('get_data'));

    }
    public function stockShop_store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'mobile' => $request->mobile,
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
            'mobile' => $request->mobile,
            'address' => $request->address,
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
            StockPayment::where('shop_id', $id)->delete();
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

    //get stock out type user, box etc
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
    // stock out (user, box, return , warranty, tg)
    public function stockOut(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        $stockOut = Stock::where('id', $request->stock_id)->where('vendor_id', Auth::user()->vendor_id)->first();
        if($stockOut){

            //check type (return shop or warranty ) or stock used (if stock use then insert )
            if(($request->type != 'return') && ($request->type != 'warranty')) {

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
                ];
                $store = StockOut::create($data);
                $stockOut->decrement('available', $request->qty);
            }else{
                //change status
                $stockOut->update(['used_status' => 'pending', 'status' => $request->type]);
            }
            if($request->type == 'return'){

                StockPayment::create([
                    'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
                    'shop_id' => $stockOut->shop_id,
                    'invoice' => 'Sales Return',
                    'buy_return' =>  $stockOut->price,
                    'notes' =>  $request->notes,
                    'payment_by' => Auth::id(),
                    'payment_date' =>  $request->stock_date,
                ]);
            }
            Toastr::success('Stock out successfully.');

        }else{
            Toastr::error('Stock cannot out.!');
        }
        return back();
    }
    // stock out details
    public  function stockOutDetails($stock_id){

        $get_data = StockOut::where('stock_id', $stock_id);
        if(Auth::user()->role_id != 1){
            $get_data->where('vendor_id', Auth::user()->vendor_id);
        }
        $get_data = $get_data->get();
        return view('admin.stock.stockOut_details')->with(compact('get_data', 'stock_id'));
    }
    //get due shop previous amount
    public function get_duePayment($shop_id){
        $vendor_id = Auth::user()->vendor_id;
        $get_shop = StockShop::with(['get_stock:shop_id,price', 'get_payment:shop_id,amount,buy_return'])->where('id', $shop_id)->where('vendor_id', $vendor_id)->first();

        // get all purchase from stock table
        $purcheseAll = array_sum(array_column($get_shop->get_stock->toArray(), 'price'));
        //get all payment amount from payment table
        $payments = array_sum(array_column($get_shop->get_payment->toArray(), 'amount')) + array_sum(array_column($get_shop->get_payment->toArray(), 'buy_return'));

        echo '<input type="hidden" name="shop_id" value="'.$get_shop->id.'"><h5>'. $get_shop->name ."</h5> Total Previous Amount: ". ($purcheseAll - $payments);

    }
    //stock previous due amount payment
    public function stockPayment(Request $request){
        $request->validate([
            'shop_id' => 'required',
            'amount' => 'required',
            'payment_date' => 'required',
        ]);
        StockPayment::create([
            'vendor_id' => ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id),
            'shop_id' => $request->shop_id,
            'invoice' => $request->payment_method,
            'amount' =>  $request->amount,
            'payment_method' =>  $request->payment_method,
            'cheque_no' =>  $request->cheque_no,
            'notes' =>  $request->notes,
            'payment_by' => Auth::id(),
            'payment_date' =>  $request->payment_date,
        ]);

        return back();
    }
    //view stock by shop
    public function stockByShop($shop_id){
        $vendor_id = Auth::user()->vendor_id;
        $get_stocks = Stock::where('shop_id', $shop_id)->where('vendor_id', $vendor_id)->get();
        return view('admin.stock.stockBy')->with(compact('get_stocks', 'shop_id'));
    }
    //view stock by cateogry
    public function stockByCategory($category_id){
        $vendor_id = Auth::user()->vendor_id;
        $get_stocks = Stock::where('category_id', $category_id)->where('vendor_id', $vendor_id)->get();
        return view('admin.stock.stockBy')->with(compact('get_stocks', 'category_id'));
    }
    //used stock count by category
    public function usedStock(){
        $vendor_id = Auth::user()->vendor_id;
        //$data['get_data'] = StockCategory::with('getUsedStocks:category_id,used_status')->where('vendor_id', $vendor_id)->get();

        $data['get_data'] = Stock::where('vendor_id', $vendor_id)->where('status', 'warranty')->groupBy('category_id')->select('category_id',
            DB::raw('sum(used_status = "good") as good'),
            DB::raw('sum(used_status = "pending") as pending'),
            DB::raw('sum(used_status = "warranty") as warranty'),
            DB::raw('sum(used_status = "recyle") as recyle'),
            DB::raw('sum(used_status = "normal") as normal')
        )->get();

        return view('admin.stock.stockUsed')->with($data);
    }

    //view stock by cateogry
    public function stockUsedByCategory($category_id){
        $vendor_id = Auth::user()->vendor_id;
        $get_stocks = Stock::where('category_id', $category_id)->where('vendor_id', $vendor_id)->where('status', 'warranty')->get();
        return view('admin.stock.stockUsedByCategory')->with(compact('get_stocks', 'category_id'));
    }

    public function stockSendType($id){
        $get_data = Stock::where('id', $id)->where('vendor_id', Auth::user()->vendor_id)->first();
        echo view('admin.stock.stockSendType')->with(compact('get_data'));
    }

    public function stockSend(Request $request){

        $vendor_id = Auth::user()->vendor_id;
        $stockSend = Stock::where('id', $request->stock_id)->where('vendor_id', Auth::user()->vendor_id)->first();

        $stockSend->used_status = $request->type;
        $stockSend->repair_date = $request->send_date;
        $stockSend->notes = $request->notes;
        if(isset($request->return_stock)){
            $stockSend->status = 'stock';
        }
        $stockSend = $stockSend->save();
        if($stockSend){
            Toastr::success('Stock send successfully.');
        }else{
            Toastr::error('Stock send out.!');
        }
        return back();

    }

    public function stockPaymentHistory($shop_id){

        $get_data = StockPayment::with(['get_stockPayment:invoice,price'])->where('shop_id', $shop_id)->get();
        return view('admin.stock.stock_payment_history')->with(compact('get_data', 'shop_id'));
    }

    public function stockByinvoice($invoice){
        $vendor_id = Auth::user()->vendor_id;
        $get_stocks = Stock::where('invoice', $invoice)->where('vendor_id', $vendor_id)->get();
        return view('admin.stock.stockBy')->with(compact('get_stocks', 'invoice'));
    }
}
