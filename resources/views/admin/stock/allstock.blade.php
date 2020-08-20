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
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Code</th>
                                                <th>Serial</th>
                                                <th>Model</th>
                                                <th>Quantity</th>
                                                <th>Available</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach($get_stocks as $data)
                                            <tr id="item{{$data->id}}">
                                                <td>{{$data->name}}</td>
                                                <td>@if($data->get_category){{$data->get_category->name}}@endif</td>
                                                <td>{{$data->code}}</td>
                                                <td>{{$data->serial}}</td>
                                                <td>{{$data->model}}</td>
                                                <td>{{$data->quantity}}</td>
                                                <td>{{$data->quantity}}</td>
                                                <td>@if($data->get_category){{$data->get_category->name}}@endif</td>
                                                <td>{{$data->price}}</td>
                                                <td>{!!($data->status == 1) ? '<span class="label label-info"> Active</span>' : '<span class="label label-danger"> Deactive </span>'!!}  
                                                </td>
                                                <td>
                                                    <button type="button" onclick="stockOut('{{$data->id}}')"  data-toggle="modal" data-target="#stockOut" class="btn btn-primary btn-sm"><i class="ti-up" aria-hidden="true"></i> Stock Out</button>

                                                    <button type="button" onclick="edit('{{$data->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                    <button data-target="#delete" onclick="confirmPopup('{{route("stock.delete", $data->id)}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                </td>
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
        <!-- add Modal -->
        <div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add stock</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="{{route('stock.store')}}" method="POST" class="floating-labels">
                                {{csrf_field()}}
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row justify-content-md-center">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="name">Stock Item</label>
                                                <input  name="name" id="name" value="{{old('name')}}" required="" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="supplier_id">Shop Name</label>
                                                <select required name="shop_id" id="supplier_id" class="form-control custom-select">
                                                    <option value="">Select Shop</option>
                                                    @foreach($shops as $shop)
                                                        <option value="{{$shop->id}}">{{$shop->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="brand_id">Brand name</label>
                                                <select required name="brand_id" id="brand_id" class="form-control custom-select">
                                                    <option value="">Select Brand</option>
                                                    @foreach($get_brand as $brand)
                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="category">Category Name</label>
                                                <select  required name="category_id" id="category" class="form-control custom-select">
                                                    <option value="">Select Category</option>
                                                    @foreach($get_category as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="product_code">Product Code</label>
                                                <input  name="product_code" id="product_code" value="{{old('product_code')}}" type="text" class="form-control">
                                            </div>
                                        </div>
                                    
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Serial">Serial</label>
                                                <input  name="serial" id="Serial" value="{{old('serial')}}" type="text" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Model">Model</label>
                                                <input  name="model" id="Model" value="{{old('model')}}" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mac">Mac</label>
                                                <input  name="mac" id="mac" value="{{old('mac')}}" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="port">Port</label>
                                                <input  name="port" id="port" value="{{old('port')}}" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="qty">Quantity</label>
                                                <input  name="qty" id="qty" value="{{old('qty')}}" type="number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="warranty">Warranty</label>
                                                <input  name="warranty" id="warranty" value="{{old('warranty')}}" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="price">Price</label>
                                                <input required name="price" id="price" value="{{old('price')}}" type="number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="stock_date">Stock Date</label>
                                                <input name="stock_date" id="stock_date" value="{{date('m/d/Y')}}" required="" type="date" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row justify-content-md-center">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="background: #fff;top:-10px;z-index: 1" for="notes">Notes</label>
                                                <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{old('notes')}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="head-label">
                                                <label class="switch-box">Status</label>
                                                <div  class="status-btn" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="status">
                                                        <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Add Stock</button>
                                                <button type="reset" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <form action="{{route('stock.update')}}"  method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update stock</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>

        <!-- delete Modal -->
        @include('admin.modal.delete-modal')

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

    </script>

    <script type="text/javascript">

      function edit(id){
          
            var  url = '{{route("stock.edit", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#edit_form").html(data);
                }
            }

        });

    }
    </script>

@endsection
