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
                        <h4 class="text-themecolor">Ticket Compose</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Ticket</a></li>
                                <li class="breadcrumb-item active">Compose</li>
                            </ol>
                            <a href="{{route('ticket.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Ticket lists</a>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="row">
                                
                                <div class="col-xlg-10 col-lg-10 col-md-10 bg-light border-left">
                                    <div class="card-body">
                                        <h3 class="card-title">Compose New Ticket</h3>
                                        <form action="{{route('ticket.store')}}" method="POST" class="floating-labels">
                                        {{csrf_field()}}
                                        
                                        
                                        <div class="form-group">
                                            <label class="required" for="title">Ticket Title</label>
                                            <input  name="title" id="title" value="{{old('title')}}" required="" type="text" class="form-control">
                                        </div><br/>
                                    
                                        <div class="form-group">
                                            <label style="background: #fff;top:-10px;z-index: 1" for="ticket_details">Ticket Description</label>
                                            <textarea name="ticket_details" class="textarea_editor form-control" placeholder="Enter details" id="ticket_details" rows="5">{{old('ticket_details')}}</textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success m-t-20"><i class="fa fa-envelope-o"></i> Send</button>
                                        <button class="btn btn-dark m-t-20"><i class="fa fa-times"></i> Discard</button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
              
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
 
@endsection
@section('js')

 
  
<script src="{{asset('assets')}}/node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="{{asset('assets')}}/node_modules/html5-editor/bootstrap-wysihtml5.js"></script>

    <script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();

    });
    </script>
@endsection
