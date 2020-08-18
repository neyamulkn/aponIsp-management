@extends('layouts.master')
@section('title', 'Stock details')
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
                        <h4 class="text-themecolor">Stock details</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Stock</a></li>
                                <li class="breadcrumb-item active">details</li>
                            </ol>
                            <button type="button" onclick="stockOut('{{$stock_id}}')"  data-toggle="modal" data-target="#stockOut" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-upload" aria-hidden="true"></i> Stock Out</button>
                           
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
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Out Date</th>
                                                <th>Type</th>
                                                <th>Used By</th>
                                                <th>Stock</th>
                                                <th>Quantity</th>
                                                <th>Available</th>
                                                <th>Amount</th>
                                                <th>Created By</th>
                                                <th>Details</th>
                                                <th>Status</th>
                                               
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach($get_data as $data)
                                            <tr>
                                                <td>{{Carbon\Carbon::parse($data->date)->format(Config::get('siteSetting.date_format'))}}</td>
                                                <td>{{$data->type}}</td>
                                                <td>@if($data->type == 'box') {{$data->get_box->name}} @endif @if($data->type == 'user') {{$data->get_user->name}} @endif </td>
                                                <td>{{$data->available}}</td>
                                                <td>{{$data->quantity}}</td>
                                                <td><span @if(($data->available - $data->quantity)<0) style="color:red" @endif>{{$data->available - $data->quantity}}</span></td>
                                                <td>{{$data->price}}</td>
                                                <td><a href="{{route('user.profile', $data->supply_by->username)}}"> {{$data->supply_by->name}}</a></td>
                                                <td>{!!$data->notes!!} </td>
                                                <td>{!!$data->status!!} </td>
                                               
                                            </tr>
                                            @endforeach
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
        <div class="modal fade" id="stockOut" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <form action="{{route('stock.out')}}" class="floating-labels" method="post">
                      {{ csrf_field() }}

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Stock out</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="required" for="stockOutType">Wherever used</label>
                                <select required name="type" id="stockOutType" class="form-control custom-select">
                                    <option value="">Select one</option>
                                    <option value="user">User</option>
                                    <option value="box">Box</option>
                                    <option value="tg">TG</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="stockOutByField"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="stockOutqty">Quantity</label>
                                <input  name="qty" id="stockOutqty" value="{{old('qty')}}" type="number" min="0" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="amount">Price</label>
                                <input required name="price" id="amount" value="{{old('price')}}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="required" for="stockout_date">Stock Out Date</label>
                                <input  type="date" name="stock_date" id="stockout_date" value="{{old('stock_date') ? old('stock_date') : Carbon\Carbon::parse(now())->format('Y-m-d')}}" required="" type="date" class="form-control">
                            </div>
                        </div>

                       <div class="col-md-12">
                            <div class="form-group">
                                <label style="background: #fff;top:-10px;z-index: 1" for="notes">Notes</label>
                                <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{old('notes')}}</textarea>
                            </div>
                        </div>
                                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="stock_id" name="stock_id"  value="{{$stock_id}}" class="btn btn-sm btn-success">Stock out</button>
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
