@extends('layouts.master')
@section('title', 'Stock Category list')
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
                        <h4 class="text-themecolor">Stock Category List</h4>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Stock Category</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#add" class="btn btn-success d-none d-lg-block m-l-15"><i
                                class="fa fa-plus-circle"></i> Add New Stock</button>
                            <button data-toggle="modal" data-target="#categoryModal" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add Category</button>
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
                                    <table id="myTable" class="table table-bordered color-table warning-table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Category Name</th>
                                                <th>Quantity</th>
                                                <th>Available</th>
                                                <th>Amount</th>
                                                <th>Order Alert</th>
                                                <th>Notes</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @if(count($get_data)>0)
                                            <?php $totalQty = $available =$totalAvailable = $totalPrice = $qty =  $price = 0;?>
                                            @foreach($get_data as $data)
                                            <?php  
                                                if($data->get_stocks){ 
                                                    $qty = $data->get_stocks->sum('quantity');
                                                    $price = $data->get_stocks->sum('price');
                                                    $available = $data->get_stocks->sum('available');
                                                }
                                                $totalQty += $qty;
                                                $totalPrice += $price;
                                                $totalAvailable += $available;
                                             ?>
                                            
                                            <tr id="item{{$data->id}}">
                                                <td><a href="{{ route('stock.ByCategory',[ $data->id, $data->name]) }}"> {{$data->name}} </a> </td>
                                                <td>{{ $qty }}</td>
                                                <td>{{ $available }}</td>
                                                 <td>{{Config::get('siteSetting.currency_symble')}}{{$price}} </td>
                                                <td>@if($qty<=5) <span style="color: red"> 25% </span>@elseif($qty<=10) <span style="color: blue"> 50% </span>
                                                @elseif($qty<=15) <span style="color: green"> 75% </span>
                                                @else <span style="color: red"> 25% </span> @endif
                                                </td>
                                                <td>{{$data->notes}}</td>
                                                <td>{!!($data->status == 1) ? "<span class='label label-info'>Active</span>" : '<span class="label label-danger">Deactive</span>'!!} 
                                                </td>
                                                <td>
                                                    <button type="button" onclick="edit('{{$data->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                    <button data-target="#delete" onclick="deleteConfirmPopup('{{ route("stockCategory.delete", $data->id) }}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr class="tbl-footer"><td>Total</td><td>{{ $totalQty}}</td><td>{{$totalAvailable}}</td><td>{{Config::get('siteSetting.currency_symble')}}{{$totalPrice}}</td><td></td><td></td><td></td><td></td></tr>
                                            @else <tr style="text-align: center;"><td colspan="7">Stock not found.</td></tr> @endif
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
        @include('admin.stock.modal.category-add')
        <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <form action="{{route('stockCategory.update')}}"  method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Stock Category</h4>
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
         <!-- add Modal -->
        @include('admin.stock.modal.stock-add')
        <!-- delete Modal -->
        @include('admin.modal.delete-modal')


@endsection
@section('js')
    <!-- This is data table -->
    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
   <script>
         $('#myTable').dataTable({ "ordering": false });

    </script>

    <script type="text/javascript">

    function edit(id){
        $('#edit_form').html('<div id="loading"></div>');
        var  url = '{{route("stockCategory.edit", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#edit_form").html(data);
                }
            },
            // $ID Error display id name
            @include('common.ajaxError', ['ID' => 'dit_form'])

        });
    }

</script>


@endsection
