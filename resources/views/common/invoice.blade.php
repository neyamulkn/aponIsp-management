@extends('layouts.master')
@section('title', 'Invoice')
@section('css-top')

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
                        <h4 class="text-themecolor">Invoice</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Invoice</a></li>
                                <li class="breadcrumb-item active">view</li>
                            </ol>
                            <a href="{{route('invoice.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-list"></i> Invoice List</a>
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
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <h3><b>INVOICE</b> <span class="pull-right">#5669626</span></h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pull-left">
                                        <address>
                                            <h3> &nbsp;<b class="text-danger">Apon IT</b></h3>
                                            <p class="text-muted m-l-5">E 104, Dharti-2,
                                                <br/> Nr' Viswakarma Temple,
                                                <br/> Talaja Road,
                                                <br/> Bhavnagar - 364002</p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right text-right">
                                        <address>
                                            <h3>To,</h3>
                                            <h4 class="font-bold">Gaala & Sons,</h4>
                                            <p class="text-muted m-l-30">E 104, Dharti-2,
                                                <br/> Nr' Viswakarma Temple,
                                                <br/> Talaja Road,
                                                <br/> Bhavnagar - 364002</p>
                                            <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> 23rd Jan 2017</p>
                                            <p><b>Due Date :</b> <i class="fa fa-calendar"></i> 25th Jan 2017</p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Name</th>
                                                    <th class="text-right">Package</th>
                                                    <th class="text-right">Price</th>
                                                    <th class="text-right">Discount</th>
                                                   
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>Neyamul</td>
                                                    <td class="text-right">Standard</td>
                                                    <td class="text-right"> $24 </td>
                                                    <td class="text-right"> 0% </td>
                                                    <td class="text-right"> $48 </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <p>Sub - Total amount: $13,848</p>
                                        <p>vat (0%) : $00 </p>
                                        <hr>
                                        <h3><b>Total :</b> $13,986</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-danger" type="submit"> Proceed to payment </button>
                            <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
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

    <script src="{{asset('js')}}/pages/chat.min.js"></script>
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

<script src="{{asset('js')}}/pages/jquery.PrintArea.js" type="text/JavaScript"></script>
    <script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
    </script>

@endsection
