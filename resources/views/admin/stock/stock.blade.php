@extends('layouts.master')
@section('title', 'Stock list')
@section('css')
<style type="text/css">
    .tbl-footer{background: #fec107ba;font-weight: 700;}
    .tbl-footer td{padding: 3px;}
</style>
@endsection
@section('content')
        
    <div class="page-wrapper">
      
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">All Stock List</h4>
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
                            <form action="{{ route('stock') }}" method="get" class="floating-labels">
                            <div class="row">
                                <div class="col-md-12">All Stock Balance/ Report
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Item">Item Name</label>
                                        <input name="q" id="Item" type="text" value="{{ Request::get('q') }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="srccategory">Category Name</label>
                                        <select name="category" id="srccategory" class="form-control custom-select">
                                            <option value="">All Category</option>
                                            @foreach($get_category as $category)
                                                <option @if(Request::get('category') == $category->id ) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button style="color: #fff" class="form-control btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table  table-striped color-table warning-table">
                                    <thead>
                                        <tr>
                                            <th>Stock Name</th>
                                            <th>Brand</th>
                                            <th>Code</th>
                                            <th>Serial</th>
                                            <th>Model</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Available</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @if(count($get_stocks)>0)
                                        @foreach($get_stocks as $data)
                                        <tr id="item{{$data->id}}">
                                            <td><a href="{{route('stock.outDetails', [$data->id, $data->name] )}}" title="View details">{{$data->name}}</a></td>
                                            <td>@if($data->get_category){{$data->get_category->name}}@endif</td>
                                            <td>{{$data->code}}</td>
                                            <td>{{$data->serial}}</td>
                                            <td>{{$data->model}}</td>
                                           
                                            <td>@if($data->get_category){{$data->get_category->name}}@endif</td>
                                             <td>{{$data->quantity}}</td>
                                            <td><span @if($data->available<0) style="color:red" @endif>{{$data->available}}</span></td>
                                            <td>{{$data->price}}</td>
                                            <td>In {{$data->status}}</td>
                                            <td>
                                                <button type="button" @if($data->available > 0 && $data->status != 'return' && $data->status != 'warranty') onclick="stockOut('{{$data->id}}')"  data-toggle="modal" data-target="#stockOut" @else title="Stock in {{$data->status}}" style="cursor:not-allowed" disabled @endif class="btn btn-primary btn-sm"><i class="fa fa-upload" aria-hidden="true"></i> Stock Out</button>

                                            
                                                 <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-cog"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item text-inverse" title="View Stock Out History" data-toggle="tooltip" href="{{route('stock.outDetails', [$data->id, $data->name] )}}"><i class="ti-eye"></i> Stock Out History</a>
                                                           
                                                            <span title="Edit Shop" data-toggle="tooltip">
                                                            <a type="button" onclick="editStock('{{$data->id}}')"  data-toggle="modal" data-target="#edit" class="dropdown-item"  href=""><i class="ti-pin-alt"></i> Edit</a></span>
                                                            
                                                            <span title="Delete" data-toggle="tooltip"><button   data-target="#delete" onclick='deleteConfirmPopup("{{route("stockShop.delete", $data->id)}}")'  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Delete Stock</button></span>
                                                        </div>
                                                    </div>
                                               
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="tbl-footer"><td></td><td></td><td></td><td></td><td></td><td></td><td>{{ $totalQty }}</td><td>{{ $availableQty }}</td><td>{{ $totalAmount }}</td><td></td><td></td></tr>
                                        @else <tr style="text-align: center;"><td colspan="11">Stock not found.</td></tr> @endif
                                    </tbody>
                                </table>
                                {{$get_stocks->appends(request()->query())->links()}}
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
    @include('admin.stock.modal.stock-add')
    <!-- stockOut Modal -->
    @include('admin.stock.modal.stock-out')
    <!-- delete Modal -->
    @include('admin.modal.delete-modal')

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

@endsection
@section('js')


    <script type="text/javascript">

    function editStock(id){
          
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
