@extends('layouts.master')
@section('title', 'Spliter list')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
<style type="text/css">

select{
   
    background: #fff !important;
    color:#000 !important;

}
select option[value="2"] {
  background: red;
}

</style>
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
                        <h4 class="text-themecolor">Spliter List</h4>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Spliter</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#add" class="btn btn-success d-none d-lg-block m-l-15"><i
                                class="fa fa-plus-circle"></i> Add New Spliter</button>
                           
                        </div>
                    </div>
                </div>
    
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">

                        <div class="card ">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered  table-striped">
                                        <thead>
                                            <tr>
                                                <th>Spliter Name</th>
                                                <th>Total Core</th>
                                                <th>Active Core</th>
                                                <th>Available Core</th>
                                                <th>Notes</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                           
                                            @foreach($get_data as $data)
                                            <tr id="item{{$data->id}}">
                                                <td>{{ $data->spliter_name }}</td>
                                                <td>{{ $data->spliter_core}}</td>
                                                <td>{{ $data->active_core}}</td>
                                                <td>{{ $data->inactive_core}}</td>
                                                <td>{{ $data->notes }}</td>
                                                <td>{!!($data->status == 1) ? "<span class='label label-info'>Active</span>" : '<span class="label label-danger">Deactive</span>'!!} 
                                                </td>
                                                <td>
                                                   <button type="button" onclick="getAllCore('{{$data->id}}')"  data-toggle="modal" data-target="#modalSpliterCore" class="btn btn-warning btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View Core</button>
                                                   
                                                    <button type="button" onclick="edit('{{$data->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                    <button data-target="#delete" onclick="deleteConfirmPopup('{{ route("spliter.delete", $data->id) }}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
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
        @include('admin.network-map.modal.spliter')
        <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <form action="{{route('spliter.update')}}"  method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update spliter</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        <!-- Spliter Core Modal -->
        <div class="modal fade" id="modalSpliterCore" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog ">
                <form action="{{route('spliter.extendCore')}}"  method="post">
                    {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Spliter Core List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="showSpliterCore"></div>
                   
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
        $('#myTable').dataTable({ "ordering": false });
    </script>

    <script type="text/javascript">

        function edit(id){
            $('#edit_form').html('<div id="loading"></div>');
            var  url = '{{route("spliter.edit", ":id")}}';
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
        // get spliter core by spliter by id
        function getAllCore(id){
            $('#showSpliterCore').html('<div id="loading"></div>');
            var  url = '{{route("spliter.showAllCore", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#showSpliterCore").html(data);
                    }
                },
                // $ID Error display id name
                @include('common.ajaxError', ['ID' => 'showSpliterCore'])

            });
        }   

        //get spliter all list
        function getSpliter(parent_id, id){
            $('#showSpliterCore').html('<div id="loading"></div>');
            var  url = '{{route("spliter.getAllSpliter", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                data:{parent_id:parent_id},
                success:function(data){
                    if(data){
                        $("#showSpliterCore").html(data);
                    }
                },
                // $ID Error display id name
                @include('common.ajaxError', ['ID' => 'showSpliterCore'])

            });
        }

    </script>
    <!-- show core list by core  -->
    <script type="text/javascript">
        function ShowCore(id){
            var output='';
            var i;
            for(i = 1; i<=id; i++){
                output += '<label for="example-color-input" class="col-3 col-md-3 text-right col-form-label">Core '+i+'</label><div class="col-8 col-md-2"><input name="core_no['+i+']" class="form-control" type="color" value="#563d7c" id="example-color-input"></div>';
            }

            $('#spliterShowCoreadd').html(output);  
        }
    </script>

@endsection
