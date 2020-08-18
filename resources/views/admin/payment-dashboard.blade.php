@extends('layouts.master')
@section('title', 'payment list')
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
                    <h4 class="text-themecolor">Payments Dashboard</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">payments</li>
                        </ol>
                        <button type="button" data-toggle="modal" data-target="#add-payment" class="btn btn-info d-none d-lg-block m-l-15"><i
                                class="fa fa-plus-circle"></i> Create New payment</button>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Payable</h4>
                                <div class="text-right">
                                    <h1 class="font-light"><i class="fa fa-donate text-success"></i> 120</h1>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Payments</h4>
                                <div class="text-right"> 
                                    <h1 class="font-light"><i class="text-success fa fa-dollar-sign text-success"></i> 5,000</h1>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Paid Invoices</h4>
                                <div class="text-right"> 
                                    <h1 class="font-light"><i class="text-success far fa-handshake"></i> 8,000</h1>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Unpaid Invoices</h4>
                                <div class="text-right"> 
                                    <h1 class="font-light"><i class="fa fa-money-bill-alt text-success"></i> $12,000</h1>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">CURRENT MONTH</h5>
                                <table class="table browser">
                                    <tbody>
                                       <tr>
                                            
                                            <td>TOTAL PAYMENTS</td>
                                            <td align="right"><span >23%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>PAID INVOICES</td>
                                            <td align="right"><span>15%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>UNPAID INVOICES</td>
                                            <td align="right"><span>07%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>PAID REQUESTS</td>
                                            <td align="right"><span>09%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>UNPAID REQUESTS</td>
                                            <td align="right"><span>23%</span></td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">NEXT MONTH</h5>
                                <table class="table browser">
                                    <tbody>
                                       <tr>
                                            
                                            <td>TOTAL PAYMENTS</td>
                                            <td align="right"><span >23%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>PAID INVOICES</td>
                                            <td align="right"><span>15%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>UNPAID INVOICES</td>
                                            <td align="right"><span>07%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>PAID REQUESTS</td>
                                            <td align="right"><span>09%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>UNPAID REQUESTS</td>
                                            <td align="right"><span>23%</span></td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">LAST MONTH</h5>
                                <table class="table browser">
                                    <tbody>
                                        <tr>
                                            
                                            <td>TOTAL PAYMENTS</td>
                                            <td align="right"><span >23%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>PAID INVOICES</td>
                                            <td align="right"><span>15%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>UNPAID INVOICES</td>
                                            <td align="right"><span>07%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>PAID REQUESTS</td>
                                            <td align="right"><span>09%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>UNPAID REQUESTS</td>
                                            <td align="right"><span>23%</span></td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div> 
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            
                            <div class="table-responsive">
                                <table id="demo-foo-addrow" class="table table-hover contact-list"
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
                                        
                                            <td>1</td>

                                            <td>fasfd</td>
                                            <td>
                                               fasdf
                                            </td>
                                            
                                            <td>fasdf</td>
                                            <td>fds</td>
                                            <td>
                                                <span class="label label-warning">data</span> 
                                            </td>
                                            
                                            <td>
                                                <a title="View" href="#" class="btn btn-success btn-sm"><i class="ti-eye"></i></a>
                                                <button title="Edit payment" type="button" onclick="edit(2)"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i></button>
                                                <button title="Delete payment" data-target="#delete" onclick="confirmPopup(2)" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> </button>
                                            </td>
                                        </tr>
                                    
                                        
                                    </tbody>
                                    
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

    <div class="modal fade" id="add-payment" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create New payment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                    <div class="card-body">
                        <form action="{{route('payment.store')}}" method="POST" class="floating-labels">
                            {{csrf_field()}}
                            <div class="form-body">
                                <!--/row-->
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required" for="title">payment Title</label>
                                            <input  name="title" id="title" value="{{old('title')}}" required="" type="text" class="form-control">
                                        </div>
                                    </div>
                                 
                                </div>
                                <div class="row justify-content-md-center">
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="background: #fff;top:-10px;z-index: 1" for="payment_details">payment Description</label>
                                            <textarea name="payment_details" class="textarea_editor form-control" placeholder="Enter details" id="payment_details" rows="3">{{old('payment_details')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        
                                        <div class="form-actions">
                                            <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Send </button>
                                            <button type="button" data-dismiss="modal" class="btn btn-inverse">Discard</button>
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
