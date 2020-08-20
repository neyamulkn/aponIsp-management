@extends('layouts.master')
@section('title', 'Stock list')
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
                        <h4 class="text-themecolor">Stock List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Stock</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add New Stock</button>
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
                                    <table id="myTable" class="table color-table warning-table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Return Date</th>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Code</th>
                                                <th>Serial</th>
                                                <th>Mac</th>
                                                <th>Model</th>
                                                <th>Port</th>
                                                <th>Supplier</th>
                                                <th>Warranty</th>
                                                <th>Details</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead> 
                                        <tbody> 
                                            @if(count($get_stocks)>0)
                                            @foreach($get_stocks as $data)
                                            <tr id="item{{$data->id}}">
                                                <td>{{Carbon\Carbon::parse($data->repair_date)->format(Config::get('siteSetting.date_format'))}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>@if($data->get_brand){{$data->get_brand->name}}@endif</td>
                                                <td>{{$data->code}}</td>
                                                <td>{{$data->serial}}</td>
                                                <td>{{$data->mac}}</td>
                                                <td>{{$data->model}}</td>
                                                <td>{{$data->port}}</td>
                                               <td>@if($data->get_shop){{$data->get_shop->name}}@endif</td>
                                                <td>{{ $data->warranty }}</td>
                                                <td>{{ $data->notes }}</td>
                                                <td>{{ $data->used_status }}</td>
                                                <td>
                                                    <button type="button" onclick="StockSend('{{$data->id}}')"  data-toggle="modal" data-target="#StockSend" class="btn btn-primary btn-sm"><i class="ti-up" aria-hidden="true"></i> Stock Send</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else <tr style="text-align: center;"><td colspan="13">Stock not found.</td></tr> @endif
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
    <div class="modal fade" id="StockSend" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="{{route('stock.send')}}" method="post">
            {{ csrf_field() }}

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Stock Send</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row" id="StockSendType"> </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="stock_id" name="stock_id"  value="" class="btn btn-sm btn-success">Stock Send</button>
                </div>
              </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <!-- This is data table -->
    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready( function() {
            $('#myTable').dataTable({
                "ordering": false
            });
        })

    function StockSend(id){
        document.getElementById('stock_id').value = id; 
        var url = "{{route('stock.sendType', ':id')}}";
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $('#StockSendType').html(data);
               }else{
                    $('#StockSendType').html('');
                }
            }
        });  
    }

  </script>

@endsection
