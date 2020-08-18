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
                    <h4 class="text-themecolor">payments</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">payments</li>
                        </ol>
                        <button type="button" data-toggle="modal" data-target="#add-payment" class="btn btn-info d-none d-lg-block m-l-15"><i
                                class="fa fa-plus-circle"></i> Create New Payment</button>
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
                                           
                                            <th>Date</th>
                                            <th>Invoice</th>
                                            <th>Cutomer Name</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $payments as $payment)
                                        <tr>
                                        
                                            <td>{{Carbon\Carbon::parse($payment->payment_date)->format('d M, Y')}}</td>

                                            <td>{{$payment->invoice_id}}</td>
                                            <td>{{$payment->user->name}}</td>
                                            
                                            <td>{{$payment->amount}}</td>
                                            <td>{{$payment->paymethod->name}}</td>
                                            <td>
                                                @if($payment->status == 1)
                                                <span class="label label-success">Paid</span>
                                                @else
                                                <span class="label label-warning">UnPaid</span>
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <a title="View" href="#" class="btn btn-success btn-sm"><i class="ti-eye"></i></a>
                                                <button title="Edit payment" type="button" onclick="edit(2)"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i></button>
                                                <button title="Delete payment" data-target="#delete" onclick="confirmPopup(2)" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    
                                </table>
                                {{$payments->links()}}
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
                                            <label for="user_id">Select Customer</label>
                                            <select required="" name="user_id" id="user_id" class="form-control custom-select">
                                                <option value="">Select Customer</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <label  for="payment_date">Payment date</label>
                                           <input required onfocus="(this.type='date')" onblur="(this.type='text')" type="date" id="payment_date" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter join date" value="{{old('payment_date') ? old('payment_date') : date('Y-m-d')}}" class="form-control" name="payment_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pay_month">Select month</label>
                                            <input required type="month" id="pay_month" name="pay_month" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status">Payment Status</label>
                                            <select required name="status" id="status" class="form-control custom-select">
                                                
                                                <option value="">Select Status</option>
                                                <option value="1">Paid</option>
                                                <option value="2">UnPaid</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <label  for="amount">Amount</label>
                                           <input required type="number" class="form-control" id="amount" value="{{ old('amount')}}" name="amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pay_method">Payment Method</label>
                                            <select required="" name="pay_method" id="pay_method" class="form-control custom-select">
                                                
                                                <option value="">Select Method</option>
                                                @foreach($paymethods as $paymethod)
                                                <option value="{{$paymethod->id}}">{{$paymethod->name}}</option>
                                                @endforeach
                                                
                                            </select>
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
