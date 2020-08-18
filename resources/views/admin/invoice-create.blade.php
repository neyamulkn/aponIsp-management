@extends('layouts.master')
@section('title', 'Invoice Create')
@section('css')
<link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    @media screen and (min-width: 640px) {
        .divrigth_border::after {
            content: '';
            width: 0;
            height: 100%;
            margin: -1px 0px;
            position: absolute;
            top: 0;
            left: 100%;
            margin-left: 0px;
            border-right: 3px solid #e5e8ec;
        }
    }
    .dropify_image{
        position: absolute;top: -14px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;
    }
    .dropify-wrapper{
        height: 100px !important;
    }
  

</style>
@endsection

@section('content')

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Add New invoice</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">invoice</a></li>
                                <li class="breadcrumb-item active">create</li>
                            </ol>
                        <a href="{{route('invoice.list')}}" class="btn btn-info btn-sm d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> invoice List</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            
            <div class="card">
                <div class="card-body">
                    <div class="title_head">Generate Auto Invoices & Bills</div>
                    <div class="row justify-content-md-center">
                        <div class="col-sm-8">
                            <form action="{{route('invoice.store')}}" enctype="multipart/form-data" class="" method="post" id="invoice">
                            @csrf
                               
                                <div class="form-group row">
                                    <label for="example-date-input" class="col-2 col-form-label">Invoice Create Date</label>
                                    <div class="col-10">
                                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-month-input" class="col-2 col-form-label">Due Month</label>
                                    <div class="col-10">
                                        <input class="form-control" type="month" value="2011-08" id="example-month-input">
                                    </div>
                                </div>
                                
                                <hr>
                                <div class="form-actions pull-right">
                                    <button type="submit"  name="submit" value="save" class="btn btn-success"> <i class="fa fa-save"></i> Invoice generate now </button>
                                    
                                    <button type="reset" class="btn waves-effect waves-light btn-secondary">Cancel</button>
                                </div>
                                
                            </form>
                        
                        </div>
                    </div><br/>
                
                        
                    <div class="title_head">Generate Manually Invoices & Bills</div>
                    <div class="row justify-content-md-center">
                        <div class="col-sm-8">
                            <form action="{{route('invoice.store')}}" enctype="multipart/form-data" class="" method="post" id="invoice">
                                @csrf
                               
                                <div class="form-group row">
                                    <label for="example-month-input2" class="col-2 col-form-label">Select</label>
                                    <div class="col-10">
                                        <select required="" name="user_id" id="user_id" class="form-control custom-select">
                                        <option value="">Select Customer</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-month-input" class="col-2 col-form-label">Invoice Date</label>
                                    <div class="col-10">
                                        <input required onfocus="(this.type='date')" onblur="(this.type='text')" type="date" id="invoice_date" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter join date" value="{{old('invoice_date') ? old('invoice_date') : date('Y-m-d')}}" class="form-control" name="invoice_date">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-month-input" class="col-2 col-form-label">Select Month</label>
                                    <div class="col-10">
                                        <input required type="month" id="pay_month" name="pay_month" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-2 col-form-label">Select Status</label>
                                    <div class="col-10">
                                        <select required name="status" id="status" class="form-control custom-select">
                                                
                                                <option value="">Select Status</option>
                                                <option value="1">Paid</option>
                                                <option value="2">UnPaid</option>
                                                
                                            </select>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-actions pull-right">
                                    <button type="submit"  name="submit" value="save" class="btn btn-success"> <i class="fa fa-save"></i> Invoice generate now </button>
                                    
                                    <button type="reset" class="btn waves-effect waves-light btn-secondary">Cancel</button>
                                </div>
                                
                            </form>
                        
                        </div>
                    </div>

                        
                </div>
               
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->


   
@endsection

@section('js')
   
  

@endsection

