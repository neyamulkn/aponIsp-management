@extends('layouts.master')
@section('title', $user->name.' | Profile')
@section('css')
<link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">

    .dropify-wrapper{
        height: 100px !important;
    }
    .title_head{
        width: 100%; margin-top: 5px; background: #8d8f90; color:#fff; padding: 10px;
    }

</style>
@endsection

@section('content')

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
                        <h4 class="text-themecolor">Profile</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                            <a href="{{route('user.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-angle-left"></i> Back</a>
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
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="{{asset('upload/users/avatars/'.$user->phato)}}" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10">{{$user->name}}</h4>
                                    <h6 class="card-subtitle">{{$user->dsc}}</h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a title="User status" href="javascript:void(0)" class="link"><i class="fa fa-check"></i> <font class="font-medium">{{($user->status == 1) ? 'Active' : 'Deactive'}} </font></a></div>
                                        <div class="col-4"><a title="Total Tickets " href="javascript:void(0)" class="link"><i class="fa fa-clipboard-list"></i> <font class="font-medium">54</font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> 
                                <small class="text-muted">Member Since </small>
                                <h6>{{( $user->join_date )? Carbon\Carbon::parse($user->join_date)->format('F m, Y') : 'N/A'}}</h6> 
                                <small class="text-muted p-t-30 db">Birthday</small>
                                <h6>{{($user->birthday) ? Carbon\Carbon::parse($user->birthday)->format('F m, Y') : 'N/A'}}</h6> 
                                <small class="text-muted p-t-30 db">Area</small>
                                <h6>{{'Road No: '. ($user->road_no ? $user->road_no : 'n/a').', House No: '. ($user->house_no ? $user->house_no : 'n/a'). ', Flat No: '. ($user->flat_no ? $user->flat_no : 'n/a') .' ,  '.$user->get_subzone->name .', '. $user->get_zone->name}}</h6>
                                
                                <small class="text-muted p-t-30 db">Social Profile</small>
                                <br/>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                            
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab"><i class="fa fa-user"></i> Profile</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab"> <i class="fa fa-chart-line"></i> Reports</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <label class="title_head">
                                            User Information
                                        </label>
                                        <div class="row">
                                            
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Full Name</strong>
                                                <br>
                                                <p class="text-muted">{{$user->name}}</p>
                                            </div>
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted">{{$user->mobile}}</p>
                                            </div>
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">{{$user->email}}</p>
                                            </div>
                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-xs-6"> <strong>Box Name</strong>
                                                <br>
                                                <p class="text-muted">{{($user->customer->box->name) ? $user->customer->box->name : 'N/A'}}</p>
                                            </div>
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Cable</strong>
                                                <br>
                                                <p class="text-muted">{{($user->customer->cable->name)? $user->customer->cable->name : 'N/A'}}</p>
                                            </div>
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Setup By</strong>
                                                <br>
                                                <p class="text-muted">{{$user->customer->setupBy->name}}</p>
                                            </div>
                                            
                                        </div>
                                       
                                        <label class="title_head">
                                            Package Information
                                        </label>
                                        <div class="row">
                                           
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Package Name</strong>
                                                <br>
                                                <p class="text-muted">{{$user->customer->package->pkg_name}}</p>
                                            </div>
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Bandwidth/Speed</strong>
                                                <br>
                                                <p class="text-muted">{{$user->customer->bandwidth}}</p>
                                            </div>
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Amount</strong>
                                                <br>
                                                <p class="text-muted">{{$user->customer->amount}}</p>
                                            </div>
                                            
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-4 col-xs-6"> <strong>Allowcated IP</strong>
                                                <br>
                                                <p class="text-muted">{{($user->customer->package->allowcated_ip)? $user->customer->package->allowcated_ip : 'N/A'}}</p>
                                            </div>
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Mac Address</strong>
                                                <br>
                                                <p class="text-muted">{{($user->customer->package->mac)? $user->customer->package->mac : "N/A"}}</p>
                                            </div>
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Discount</strong>
                                                <br>
                                                <p class="text-muted">{{($user->customer->package->discount) ? $user->customer->package->discount : 'N/A'}}</p>
                                            </div>
                                            
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-4 col-xs-6"> <strong>Location point</strong>
                                                <br>
                                                <p class="text-muted">{{($user->customer->location_point) ? $user->customer->location_point : 'N/A'}}</p>
                                            </div>
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Connection Type</strong>
                                                <br>
                                                <p class="text-muted">{{($user->customer->connection_type)? $user->customer->connection_type : 'N/A'}}</p>
                                            </div>
                                            <div class="col-md-4 col-xs-6 b-r"> <strong>Connectivity Type</strong>
                                                <br>
                                                <p class="text-muted">{{($user->customer->connectivity_type)? $user->customer->connectivity_type : 'N/A'}}</p>
                                            </div>
                                            
                                        </div>
                                        <hr>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                    
                                    <div class="card-body">
                                        <label class="title_head">
                                        <i class="fa fa-reports"></i>User Reports
                                    </label>
                                        <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-md-12">Full Name</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Password</label>
                                                <div class="col-md-12">
                                                    <input type="password" value="password" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Phone No</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Message</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5" class="form-control form-control-line"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12">Select Country</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>

   
@endsection

@section('js')
   
    <script src="{{asset('assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>

    <script>

      
            @if(old('zone'))
                get_subzone("{{old('zone')}}");
            @endif
            function get_subzone(id=null){
                if(id != null){
                    var  url = '{{route("get_subzone", ":id")}}';
                    url = url.replace(':id',id);
                    $.ajax({
                        url:url,
                        method:"get",
                        success:function(data){
                            if(data){
                                $("#subzone").html(data);
                                 $("#subzone").focus();
                            }else{
                                $("#subzone").html('<option>Subzone not found</option>');
                            }
                        }
                    });
                }else{
                     $("#subzone").html('<option>Select first zone</option>');
                }
            }        
       
       
    </script>

     <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
   

@endsection

