@extends('layouts.master')
@section('title', 'package list')
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
                        <h4 class="text-themecolor">Package List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Package</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <a href="{{route('package.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</a>
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
                                                <th>Package Name</th>
                                                <th>Bandwidth</th>
                                                <th>Price</th>
                                                <th>Connection Type</th>
                                                <th>Discount</th>
                                                <th>Details</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($get_data as $data)
                                            <tr id="item{{$data->id}}">
                                                <td>{{$data->pkg_name}}</td>
                                                <td>{{$data->bandwidth}}</td>
                                                <td>{{$data->price}}</td>
                                                <td>{{$data->connection_type}}</td>
                                                <td>{{($data->discount) ? $data->discount : 'N/A'}}</td>
                                                <td>{{($data->details) ? $data->details : 'N/A'}}</td>
                                                <td>{!!($data->status == 1) ? '<span class="label label-success"> Active</span>' : '<span class="label label-danger"> Deactive </span>'!!} 
                                                </td>
                                                <td>
                                                    <a href="{{route('package.edit',$data->id)}}"   class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i></a>
                                                    <button data-target="#delete" onclick="confirmPopup('{{ $data->id }}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i></button>
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
      
    
        <!-- delete Modal -->
        <div id="delete" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-title">Are you sure?</h4>
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button" value="" id="itemID" onclick="deleteItem(this.value)" data-dismiss="modal" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('js')
    <!-- This is data table -->
    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

    <!-- end - This is for export functionality only -->
    <script>
        $(function () {
            $('#myTable').DataTable();
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });


        });

    </script>

    <script type="text/javascript">

      function edit(id){
          
            var  url = '{{route("package.edit", ":id")}}';
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


     function confirmPopup(id) {

          document.getElementById('itemID').value = id;
     }
    function deleteItem(id) {

        var link = '{{route("package.delete", ":id")}}';
        var link = link.replace(':id', id);
       
            $.ajax({
            url:link,
            method:"get",
            success:function(data){
                if(data.status){
                    $("#item"+id).hide();
                    toastr.success(data.msg);
                }else{
                    toastr.error(data.msg);
                }
            }

        });
    }
// if occur error open model
    @if($errors->any())
        $("#{{Session::get('submitType')}}").modal('show');
    @endif
</script>

@endsection
