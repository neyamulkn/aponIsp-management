@extends('layouts.master')
@section('title', 'Download User')
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
                        <h4 class="text-themecolor">User download</h4>
                    </div>
                    <div class="col-xs-6 col-md-6 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                                <li class="breadcrumb-item active">download</li>
                            </ol>
                            <a href="{{route('user.create')}}" class="btn btn-info d-none btn-sm d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</a>
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
                                <label class="title_head">
                                    Select User For Download
                                </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            
                                            <select name="gender" id="gender" class="form-control custom-select">
                                               <option value="">All users</option>
                                               <option value="1">Active Users</option>
                                               <option value="0">DeActive Users</option>
                                               <option value="2">Block Users</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            
                                            <button type="submit"  name="submit" value="save" class=" btn btn-success"> <i class="fa fa-download"></i> Download </button>
                                            
                                        </div>
                                    </div>
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

        var link = '{{route("user.delete", ":id")}}';
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
