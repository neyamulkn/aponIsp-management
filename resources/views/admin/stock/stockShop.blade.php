@extends('layouts.master')
@section('title', 'Stock Shop list')
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
                        <h4 class="text-themecolor">Stock Shop list</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Stock Shop</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#shop" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add New Shop</button>
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
                                                <th>Shop Name</th>
                                                <th>Mobile</th>
                                                <th>Purchese Balance</th>
                                                <th>Total Payment</th>
                                                <th>Remaining Balance</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach($get_data as $data)
                                            <?php $purcheseAll = array_sum(array_column($data->get_stock->toArray(), 'price'));
                                                $payments = array_sum(array_column($data->get_payment->toArray(), 'amount'));
                                            ?>
                                            <tr id="item{{$data->id}}">
                                                <td><a  href="{{ route('stock.paymentHistory', [$data->id, $data->name]) }}"> {{$data->name}}</a></td>
                                                <td>{{$data->mobile}}</td>
                                                <td>{{Config::get('siteSetting.currency_symble')}}{{ $purcheseAll  }}</td>
                                                <td>{{Config::get('siteSetting.currency_symble')}}{{ $payments }}</td>
                                                <td>{{Config::get('siteSetting.currency_symble')}}{{$purcheseAll - $payments }}</td>
                                                <td>{{$data->address}}</td>
                                                <td>{!!($data->status == 1) ? "<span class='label label-info'>Active</span>" : '<span class="label label-danger">Deactive</span>'!!} 
                                                </td>
                                                <td>
                                                    <button type="button" onclick="shopPayment('{{$data->id}}')"  data-toggle="modal" data-target="#stockPayment" class="btn btn-success"><span style="font-weight: bold;" aria-hidden="true">{{Config::get('siteSetting.currency_symble')}}</span> Payment</button>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-cog"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item text-inverse" title="View Stock History" data-toggle="tooltip" href="{{ route('stock.ByShop', [$data->id, $data->name]) }}"><i class="ti-eye"></i> Stock History</a>
                                                            <a class="dropdown-item text-inverse" title="View Payment History" data-toggle="tooltip" href="{{ route('stock.paymentHistory', [$data->id, $data->name]) }}"><i class="ti-eye"></i> Payment History</a>
                                                            
                                                            <span title="Edit Shop" data-toggle="tooltip">
                                                            <a type="button" onclick="edit('{{$data->id}}')"  data-toggle="modal" data-target="#edit" class="dropdown-item"  href=""><i class="ti-pin-alt"></i> Edit</a></span>
                                                            
                                                            <span title="Delete" data-toggle="tooltip"><button   data-target="#delete" onclick='deleteConfirmPopup("{{route("stockShop.delete", $data->id)}}")'  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Delete Shop</button></span>
                                                        </div>
                                                    </div>
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
        @include('admin.stock.modal.shop')
        <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <form action="{{route('stockShop.update')}}"  method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Stock Shop</h4>
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
        
        <!-- Stock payment Modal -->
        @include('admin.stock.modal.stock-payment')
        <!-- delete Modal -->
        @include('admin.modal.delete-modal')

@endsection
@section('js')
    <!-- This is data table -->
    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
   <script>
        $('#myTable').dataTable({
                "ordering": false
            });
    </script>

    <script type="text/javascript">
   
    function edit(id){
        $('#edit_form').html('<div id="loading"></div>');
        var  url = '{{route("stockShop.edit", ":id")}}';
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
            @include('common.ajaxError', ['ID' => 'edit_form'])

        });
    }

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
