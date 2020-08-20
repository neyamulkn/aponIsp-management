@extends('layouts.master')
@section('title', Request::segment(4). ' Stock History')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">

@endsection
@section('content')
        
        <div class="page-wrapper">
          
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">{{Request::segment(4)}} stock history</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Stock</a></li>
                                <li class="breadcrumb-item active">history</li>
                            </ol>
                            <a href="{{url()->previous()}}" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-arrow-alt-circle-left"></i> Back</a>
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

                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                <table id="myTable" class="table  table-striped color-table warning-table">
                                    <thead>
                                        <tr>
                                            <th>Stock Name</th>
                                            <th>Brand</th>
                                            <th>Code</th>
                                            <th>Serial</th>
                                            <th>Mac</th>
                                            <th>Model</th>
                                            <th>Port</th>
                                            <th>Quantity</th>
                                            <th>Available</th>
                                            <th>Price</th>
                                            <th>Supplier</th>
                                            <th>Warranty</th>
                                            <th>Details</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @if(count($get_stocks)>0)
                                        @foreach($get_stocks as $data)
                                        <tr id="item{{$data->id}}">
                                            <td><a href="{{route('stock.outDetails', [$data->id, $data->name] )}}" title="View details">{{$data->name}}</a></td>
                                            <td>@if($data->get_brand){{$data->get_brand->name}}@endif</td>
                                            <td>{{$data->code}}</td>
                                            <td>{{$data->serial}}</td>
                                            <td>{{$data->mac}}</td>
                                            <td>{{$data->model}}</td>
                                            <td>{{$data->port}}</td>
                                        
                                            <td>{{$data->quantity}}</td>
                                            <td><span @if($data->available<=0) style="color:red" @endif>{{$data->available}}</span></td>
                                            <td>{{Config::get('siteSetting.currency_symble')}}{{$data->price}}</td>
                                            <td>@if($data->get_shop){{$data->get_shop->name}}@endif</td>
                                            <td>{{ $data->warranty }}</td>
                                            <td>{{ $data->notes }}</td>
                                            
                                            <td>
                                                <button type="button" @if($data->available > 0 && $data->status != 'return' && $data->status != 'warranty') onclick="stockOut('{{$data->id}}')"  data-toggle="modal" data-target="#stockOut" @else title="Stock in {{$data->status}}" style="cursor:not-allowed" disabled @endif class="btn btn-primary btn-sm"><i class="fa fa-upload" aria-hidden="true"></i> Stock Out</button>

                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="tbl-footer"><td></td><td></td><td></td><td></td><td></td><td></td><td>Total:</td><td>{{ $get_stocks->sum('quantity') }}</td><td>{{ $get_stocks->sum('quantity') }}</td><td>{{Config::get('siteSetting.currency_symble')}}{{ $get_stocks->sum('price') }}</td><td></td><td></td><td></td><td></td><td></td></tr>
                                        @else <tr style="text-align: center;"><td colspan="11">Stock not found.</td></tr> @endif
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
    <!-- stockOut Modal -->
    @include('admin.stock.modal.stock-out')

@endsection
@section('js')
    <!-- This is data table -->
    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
        $('#myTable').dataTable({ "ordering": false });

    function stockOut(id){
        document.getElementById('stock_id').value = id;   
    }

    $(document).on('change', '#stockOutType', function(e){
       
        var type = $(this).val();
        if(type){
        $.ajax({
            url:"{{route('stock.outType')}}",
            method:"get",
            data:{
                type:type
            },
            success:function(data){
                if(data){
                    $('#stockOutByField').html(data);
               }else{
                $('#stockOutByField').html('');
                }
            }
        });
        }else{
            $('#stockOutByField').html('');
        }
    });
   
    </script>
@endsection
