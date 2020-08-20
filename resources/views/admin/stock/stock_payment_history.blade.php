@extends('layouts.master')
@section('title', Request::segment(5).' Stock Payment history')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">

@endsection
@section('content')
                <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">{{Request::segment(5)}} Stock Payment history</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Stock Payment</a></li>
                                <li class="breadcrumb-item active">history</li>
                            </ol>
                           
                            <button type="button" onclick="shopPayment('{{$shop_id}}')"  data-toggle="modal" data-target="#stockPayment" class="btn btn-info d-none d-lg-block m-l-15"><span style="font-weight: bold;" aria-hidden="true">{{Config::get('siteSetting.currency_symble')}}</span> Payment</button>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">

                        <div class="card ">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Buy</th>
                                                <th>Buy Return</th>
                                                <th>Payment</th>
                                                <th>Payment by</th>
                                                <th>Closing Balance</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <?php $totalPurchase = $totalPaid = 0;?>
                                            @foreach($get_data as $data)
                                            <?php 
                                               
                                                $purchase = array_sum(array_column($data->get_stockPayment->toArray(), 'price'));
                                                
                                                $totalPurchase += $purchase;
                                                
                                                $totalPaid += ($data->amount ? $data->amount : 0) . ($data->buy_return ? $data->buy_return : 0);
                                                
                                                $closeBalance = $totalPurchase - $totalPaid;
                                                ?>
                                            <tr>
                                                <td>{{Carbon\Carbon::parse($data->date)->format(Config::get('siteSetting.date_format'))}}</td>
                                                <td>
                                                    @if($data->buy_return == null && $data->amount ==null )
                                                    <a href="{{ route('stock.Byinvoice', $data->invoice) }}"> {{ $data->invoice }}</a>
                                                    @else {{ $data->invoice }} @endif
                                                </td>
                                                <td>{{Config::get('siteSetting.currency_symble')}}@if($data->get_stockPayment){{$purchase}} @endif</td>
                                                
                                                <td>{{Config::get('siteSetting.currency_symble')}}{{ ($data->buy_return ) ? $data->buy_return : 0}}</td>
                                                <td>{{Config::get('siteSetting.currency_symble')}}{{ ($data->amount) ? $data->amount : 0 }}</td>
                                                <td>{{$data->get_user->name}}</td>
                                                <td>
                                                <span style="<?php if($totalPurchase > $totalPaid){ echo 'color:red'; } if($totalPurchase == $totalPaid){ echo 'color:green'; } if($totalPurchase < $totalPaid){ echo 'color:blue'; } ?>">
                                                    {{Config::get('siteSetting.currency_symble')}}{{$closeBalance}}
                                                </span>
                                                </td>
                                            </tr>

                                            @endforeach
                                            <tr class="tbl-footer"><td colspan="6"></td><td>Total: {{Config::get('siteSetting.currency_symble')}}{{$closeBalance}}</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- Stock payment Modal -->
        @include('admin.stock.modal.stock-payment')
@endsection
@section('js')
    <!-- This is data table -->
    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
   <script>
    $('#myTable').dataTable({ "ordering": false });

    </script>

    <script type="text/javascript">
    function shopPayment(id){
        
        var  url = '{{route("stock.duePayment", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#dueAmount").html(data);
                }
            },
            // $ID Error display id name
            @include('common.ajaxError', ['ID' => 'shop_dues'])

        });  
    }

    function PaymentMethod(type){
       
        if(type == 'cheque'){
            $('#PaymentMethodField').html('<span class="required" for="cheque_no">Cheque No</span><div class="form-group"><input required name="cheque_no" id="cheque_no" placeholder="Enter Cheque No" type="text" class="form-control"></div>');
        }else{
            $('#PaymentMethodField').html('');
        }
    }   

    </script>


@endsection
