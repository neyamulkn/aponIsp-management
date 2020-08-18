@extends('layouts.master')
@section('title', 'Ticket list')
@section('css')
  
        <!-- wysihtml5 CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/node_modules/html5-editor/bootstrap-wysihtml5.css" />
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
                    <h4 class="text-themecolor">Tickets</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Tickets</li>
                        </ol>
                        <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i
                                class="fa fa-plus-circle"></i> Create New</button>
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
                            
                            <div class="row m-t-20">
                                <!-- Column -->
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card">
                                        <div class="box bg-info text-center">
                                            <h1 class="font-light text-white">{{count($tickets)}}</h1>
                                            <h6 class="text-white">Total Tickets</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card">
                                        <div class="box bg-primary text-center">
                                            <h1 class="font-light text-white">1,738</h1>
                                            <h6 class="text-white">Responded</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card">
                                        <div class="box bg-success text-center">
                                            <h1 class="font-light text-white">1100</h1>
                                            <h6 class="text-white">Resolve</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card">
                                        <div class="box bg-dark text-center">
                                            <h1 class="font-light text-white">964</h1>
                                            <h6 class="text-white">Pending</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                            </div>
                            <div class="table-responsive">
                                <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list"
                                    data-paging="true" data-paging-size="7">
                                    <thead>
                                        <tr>
                                            <th>ID #</th>
                                            <th>Date</th>
                                            <th>Opened By</th>
                                            <th>Subject</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1011</td>

                                            <td>14-10-2017</td>
                                            <td>
                                                <a href="javascript:void(0)"><img width="30" src="{{asset('assets')}}/images/users/1.jpg"
                                                        alt="user" class="img-circle" /> Genelia Deshmukh</a>
                                            </td>
                                            
                                            <td>How to customize the template?</td>
                                            <td>How to customize the template?</td>
                                            <td><span class="label label-warning">New</span> </td>
                                            
                                            <td>
                                                <button type="button" onclick="edit()"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                <button data-target="#delete" onclick="confirmPopup()" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1224</td>
                                            <td>13-10-2017</td>
                                            <td>
                                                <a href="javascript:void(0)"><img src="{{asset('assets')}}/images/users/2.jpg"
                                                        alt="user" class="img-circle" /> Ritesh Deshmukh</a>
                                            </td>
                                           
                                            <td>How to change colors</td>
                                            <td>How to change colors</td>
                                            <td><span class="label label-success">Complete</span> </td>
                                           <td>
                                                <button type="button" onclick="edit()"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                <button data-target="#delete" onclick="confirmPopup()" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                            </td>
                                            
                                        </tr>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-info btn-rounded"
                                                    data-toggle="modal" data-target="#add-contact">Add New
                                                    Contact</button>
                                            </td>
                                            <div class="modal fade" id="add-contact" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                      <!-- Modal content-->
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Create cable</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body form-row">
                                                            <div class="card-body">
                                                                <form action="{{route('cable.store')}}" method="POST" class="floating-labels">
                                                                    {{csrf_field()}}
                                                                    <div class="form-body">
                                                                        <!--/row-->
                                                                        <div class="row justify-content-md-center">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="required" for="title">Ticket Title</label>
                                                                                    <input  name="title" id="title" value="{{old('title')}}" required="" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                         
                                                                        </div>
                                                                        <div class="row justify-content-md-center">
                                                                           <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="required" style="background: #fff;top:-10px;z-index: 1" for="ticket_detail">Ticket Description</label>
                                                                                    <textarea required="" name="ticket_detail" class="textarea_editor form-control" placeholder="Enter details" id="ticket_detail" rows="3">{{old('ticket_detail')}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row justify-content-md-center">
                                                                            <div class="col-md-12">
                                                                                
                                                                                <div class="form-actions">
                                                                                    <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                                                    <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
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
                                            <td colspan="6">
                                                <div class="text-right">
                                                    <ul class="pagination"> </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
      
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

 
    <script type="text/javascript">


     function confirmPopup(id) {

        document.getElementById('itemID').value = id;
     }
    function deleteItem(id) {

        var link = '{{route("box.delete", ":id")}}';
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
  
    <script src="{{asset('assets')}}/node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
 <script src="{{asset('assets')}}/node_modules/html5-editor/bootstrap-wysihtml5.js"></script>

    <script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();

    });
    </script>
@endsection
