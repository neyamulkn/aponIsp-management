@extends('layouts.master')
@section('title', 'staff list')
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
                    <div class="col-6 col-md-6 align-self-center">
                        <h4 class="text-themecolor">Staff List</h4>
                    </div>
                    <div class="col-xs-6 col-md-6 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <a href="{{route('staff.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</a>
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
                                                <th>Staff Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Designation</th>
                                                <th>Area</th>
                                                <th>Users</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($staffs as $staff)
                                            <tr id="item{{$staff->id}}">
                                                <td>{{$staff->user->name}}</td>
                                                <td>{{$staff->user->mobile}}</td>
                                                <td>{{$staff->user->email}}</td>
                                                <td>{{$staff->designation}} </td>
                                                
                                                <td>{{ ($staff->user->get_subzone ? $staff->user->get_subzone->name : 'N/A' ) }}</td>
                                                <td>{{count($staff->user->setup_users)}}</td>
                                                <td>{!!($staff->status == 1) ? '<span class="label label-success"> Active</span>' : '<span class="label label-danger"> Deactive </span>'!!}
                                                </td>
                                                <td>
                                                    <a title="View staff profile" href="#"   class="btn btn-success btn-sm"><i class="ti-eye" aria-hidden="true"></i></a>

                                                    <a title="Edit staff profile" href="{{route('staff.edit',$staff->id)}}"   class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i></a>
                                                    
                                                    <button title="Delete staff" data-target="#delete" onclick="confirmPopup('{{ $staff->id }}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i></button>
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
        $(document).ready( function() {
            $('#myTable').dataTable({
                "ordering": false
            });
        })

    </script>

    <script type="text/javascript">



     function confirmPopup(id) {

          document.getElementById('itemID').value = id;
     }
    function deleteItem(id) {

        var link = '{{route("staff.delete", ":id")}}';
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

</script>

@endsection
