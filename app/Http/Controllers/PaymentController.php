<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PayMethod;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(){
        return view('admin.payment-dashboard');
    }

    public function list(){
        $payments = Payment::orderBy('id', 'desc')->paginate(15);
        $paymethods = PayMethod::get();
        $users = User::where('role_id', 2)->where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.payment-list')->with(compact('users', 'payments', 'paymethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());

        $request->validate([
            'payment_date' => 'required',
            'amount' => 'required'
        ]);
        $customer = Customers::where('user_id', $request->user_id)->first();
        $invoice = Invoice::where('user_id', $request->user_id)->whereMonth('due_date', Carbon::parse($request->pay_month)->format('m'))->whereYear('due_date', Carbon::parse($request->pay_month)->format('Y'))->first();
        if($invoice){
            $value = [
                'paid_amount' => $request->amount,
                'status' => $request->status,
                'pay_method' => $request->pay_method,
                'update_by' => Auth::id(),
            ];
            $invoice = Invoice::create($value);
        }else{
            $invoice_id = Auth::id().strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), -8));
            $value = [
                'invoice_id' => $invoice_id,
                'user_id' => (Auth::user()->role_id == 1) ? $request->user_id : Auth::id(),
                'due_date' => $request->payment_date,
                'pay_month' => $request->pay_month.'-01',
                'package_id' => $customer->package_id,
                'amount' => $customer->amount,
                'paid_amount' => $request->amount,
                'discount' => $customer->discount,
                'status' => $request->status,
                'pay_method' => $request->pay_method,
                'created_by' => Auth::id(),
            ];
            $invoice = Invoice::create($value);
        }
        $data = [
            'user_id' => (Auth::user()->role_id == 1) ? $request->user_id : Auth::id(),
            'invoice_id' => $invoice->invoice_id,
            'payment_date' => $request->payment_date,
            'pay_month' => $request->pay_month.'-01',
            'amount' => $request->amount,
            'status' => $request->status,
            'pay_method' => $request->pay_method,
            'created_by' => Auth::id()
        ];
        $store = Payment::create($data);

        if($store){ Toastr::success('Payment successfully completed.'); }
        else{Toastr::error('Payment failed');}
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
