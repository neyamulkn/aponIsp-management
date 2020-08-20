@extends('layouts.master')
@section('title', 'Used Stock History')
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
                        <h4 class="text-themecolor">Used stock history</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Stock</a></li>
                                <li class="breadcrumb-item active">history</li>
                            </ol>
                            <a href="{{route('stock.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-arrow-alt-circle-left"></i> Add New Stock</a>
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
                                <table id="myTable"class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Item Category</th>
                                            <th>Good Qty</th>
                                            <th>Warranty Qty</th>
                                            <th>Normal Qty</th>
                                            <th>Recyle Bin Qty</th>
                                            <th>Pending Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @if(count($get_data)>0)
                                        <?php $good = $warranty = $normal = $recyle = $pending = 0;?>
                                        @foreach($get_data as $data)
                                           <?php 
                                                $good += $data->good;
                                                $warranty += $data->warranty;
                                                $normal += $data->normal;
                                                $recyle += $data->recyle;
                                                $pending += $data->pending;

                                            ?>
                                        <tr>
                                            <td><a href="{{route('stock.usedByCategory', [$data->category_id, $data->get_category->name] )}}" title="View details">{{$data->get_category->name}}</a></td>
                                            
                                            <td>{{ $data->good }}</td>
                                            <td>{{ $data->warranty }}</td>
                                            <td>{{ $data->normal }}</td>
                                            <td>{{ $data->recyle }}</td>
                                            <td>{{ $data->pending }}</td>
                                            
                                            <td>
                                                <a  href="{{route('stock.usedByCategory', [$data->category_id, $data->get_category->name] )}}" title="View details" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View Details</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="tbl-footer"><td></td><td>{{ $good }}</td><td>{{ $warranty }}</td><td>{{ $normal }}</td><td>{{ $recyle }}</td><td>{{ $pending }}</td><td></td></tr>
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
  
@endsection
