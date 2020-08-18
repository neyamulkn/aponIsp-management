@extends('layouts.master')
@section('title', 'Add user')
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
                    <h4 class="text-themecolor">Add New User</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                                <li class="breadcrumb-item active">create</li>
                            </ol>
                        <a href="{{route('user.list')}}" class="btn btn-info btn-sm d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> User List</a>
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
                    <form action="{{route('user.store')}}" enctype="multipart/form-data" class="floating-labels" method="post" id="user">
                        @csrf

                        <div class="form-body">
                            <div class="title_head">
                                User Information
                            </div>
                            <div class="row">
                                <div class="col-md-8 divrigth_border">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="name">Full Name</label>
                                                <input type="text" value="{{old('name')}}" name="name" required="" id="name" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter name'" class="form-control" >
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('name') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="mobile">Mobile Number</label>
                                                <input type="text" value="{{old('mobile')}}" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter mobile number'" name="mobile" required="" id="mobile" class="form-control" >
                                                @if ($errors->has('mobile'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('mobile') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="email">Email Address</label>
                                                <input type="email" value="{{old('email')}}" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter email address'" name="email" required="" id="email" class="form-control" >
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="gender">Select Gender</label>
                                                <select name="gender" id="gender" class="form-control custom-select">
                                                   <option value="">Select gender</option>
                                                   <option {{ (old('gender') == 1 ? 'selected' : '' ) }} value="1">Male</option>
                                                   <option {{ (old('gender') == 2 ? 'selected' : '' ) }} value="2">Female</option>
                                                   <option {{ (old('gender') == 3 ? 'selected' : '' ) }} value="3">Others</option>
                                                </select>
                                                @if ($errors->has('gender'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('gender') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="birthday" class="control-label">Birthday date</label>
                                                <input name="birthday" id="birthday" value="{{old('birthday')}}" onblur="(this.type='Enter birthday')" onfocus="(this.type='date')"   type="date" class="form-control">
                                                @if ($errors->has('birthday'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('birthday') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="road_no">Road No</label>
                                                <input type="text" value="{{old('road_no')}}" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter road no'" name="road_no" id="road_no" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="house_no">House No</label>
                                                <input type="text" value="{{old('house_no')}}" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter house no'" name="house_no" id="house_no" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="flat_no">Flat No</label>
                                                <input type="text" value="{{old('flat_no')}}" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter flat no'" name="flat_no"  id="flat_no" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="background: #fff;top:-10px;z-index: 1" for="user_dsc">Details</label>
                                                <textarea name="user_dsc" class="form-control" placeholder = 'Enter details' id="user_dsc" rows="1">{{old('user_dsc')}}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="district">Select District</label>
                                                <select required="" onchange="get_upzilla(this.value)" name="district" id="district" class="form-control custom-select">
                                                   <option value="">Select district</option>
                                                   @foreach($districts as $district)
                                                   <option {{ (old('district') == $district->id ? 'selected' : '' ) }} value="{{$district->id}}">{{$district->name}}</option>
                                                   @endforeach
                                                </select>
                                                @if ($errors->has('district'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('district') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="upzilla">Select Upzilla</label>
                                                <select required name="upzilla" id="upzilla" class="form-control custom-select">
                                                   <option value="">Select first district</option>
                                                </select>
                                                @if ($errors->has('upzilla'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('upzilla') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="zone">Select Zone</label>
                                                <select required="" name="zone" onchange="get_subzone(this.value)" id="zone" class="form-control custom-select">
                                                   <option value="">Select Zone</option>
                                                   @foreach($zones as $zone)
                                                   <option {{ (old('zone') == $zone->id ? 'selected' : '' ) }} value="{{$zone->id}}">{{$zone->name}}</option>
                                                   @endforeach
                                                   
                                                </select>
                                                @if ($errors->has('zone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('zone') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="subzone">Select Sub Zone</label>
                                                <select required="" name="subzone"  id="subzone" class="form-control custom-select">
                                                   <option value="">Select first zone</option>
                                                  
                                                </select>
                                                @if ($errors->has('subzone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('subzone') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-12">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Attach Image</label>
                                                <input  type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="2M"  name="phato" id="input-file-events">
                                            </div>
                                            @if ($errors->has('phato'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('phato') }}
                                                </span>
                                            @endif
                                        </div>
                                       

                                    </div>
                                </div>

                            </div>
                            <div class="title_head">
                                Package Information
                            </div>
                            <div class="row">
                                <div class="col-md-8 divrigth_border">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="package_id">Package Select</label>
                                                <select required onchange="get_package_details(this.value)" name="package_id" id="package_id" class="form-control custom-select">
                                                    <option value="">Select package</option>
                                                    @foreach($packages as $package)
                                                        <option  {{ (old('package_id') == $package->id ? 'selected' : '' ) }} value="{{ $package->id }}">{{$package->pkg_name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('package_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('package_id') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="bandwidth">Bandwidth</label>
                                                <input required type="text" value="{{old('bandwidth')}}"  name="bandwidth" id="bandwidth" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter bandwidth'" class="form-control" >
                                                @if ($errors->has('bandwidth'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('bandwidth') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="amount">Amount</label>
                                                <input required type="text" value="{{old('amount')}}"  name="amount" id="amount" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter amount'" class="form-control" >
                                                @if ($errors->has('amount'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('amount') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="allowcated_ip">Allowcated ip</label>
                                                <input type="text" value="{{old('allowcated_ip')}}"  name="allowcated_ip" id="allowcated_ip" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter allowcated ip'" class="form-control" >
                                                @if ($errors->has('allowcated_ip'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('allowcated_ip') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mac">Mac</label>
                                                <input type="text" value="{{old('mac')}}"  name="mac" id="mac" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter mac'" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="location_point">Location point</label>
                                                <input type="text" value="{{old('location_point')}}"  name="location_point" id="location_point" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter location point'" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="connection_type">Connection type</label>
                                                <input type="text" value="{{old('connection_type')}}" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter connection type'" name="connection_type" id="connection_type" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="connectivity_type">Connectivity type</label>
                                                <input type="text" value="{{old('connectivity_type')}}" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter connectivity type'" name="connectivity_type"  id="connectivity_type" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="discount">Discount</label>
                                                <input type="text" value="{{old('discount')}}"  name="discount" id="discount" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter discount'" class="form-control" >
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="background: #fff;top:-10px;z-index: 1" for="comment">Comment</label>
                                                <textarea name="comment" class="form-control" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter details'" id="comment" rows="1">{{old('comment')}}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="setup_by">Staff/Setup by</label>
                                                <select required="" name="setup_by" id="setup_by" class="form-control custom-select">
                                                   <option value="">Select setup by</option>
                                                    @foreach($staffs as $staff)
                                                        <option value="{{$staff->user->id}}">{{$staff->user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="box_id">Select Box</label>
                                                <select name="box_id" id="box_id" class="form-control custom-select">
                                                   <option value="">Select box</option>
                                                    @foreach($boxes as $box)
                                                        <option {{ (old('box_id') == $box->id ? 'selected' : '' ) }} value="{{$box->id}}">{{$box->name}}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('box_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('box_id') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cable_id">Select Cable </label>
                                                <select name="cable_id" id="cable_id" class="form-control custom-select">
                                                    <option value="">Select Cable</option>
                                                    @foreach($cables as $cable)
                                                        <option {{ (old('cable_id') == $cable->id ? 'selected' : '' ) }} value="{{$cable->id}}">{{$cable->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('box_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('box_id') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="reseller_id">Select Reseller</label>
                                                <select name="reseller_id" id="reseller_id" class="form-control custom-select">
                                                   <option value="">Select reseller</option>
                                                   <option value="1">Male</option>
                                                   <option value="2">Female</option>
                                                   <option value="3">Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="marketing_by">Marketing by</label>
                                                <select name="marketing_by" id="marketing_by" class="form-control custom-select">
                                                   <option value="">Marketing by</option>
                                                   <option value="1">Male</option>
                                                   <option value="2">Female</option>
                                                   <option value="3">Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        
                                        

                                        <div class="col-md-6">
                                           <div class="form-group">
                                                <label for="ref_by">Ref by</label>
                                                <input type="text" id="ref_by" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter ref_by" name="ref_by" class="form-control">
                                            </div>
                                        </div>

                                        

                                        <div class="col-md-6">
                                           <div class="form-group">
                                                <label for="join_date">Join Date</label>
                                                <input onfocus="(this.type='date')" onblur="(this.type='text')" type="date" id="join_date" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter join date" value="{{old('join_date') ? old('join_date') : Carbon\Carbon::parse(now())->format('Y-m-d h:m:i')}}"  name="join_date" class="form-control">
                                            </div>
                                        </div>
                                       

                                    </div>
                                </div>

                            </div>

                            <div class="title_head">
                                Account Information
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">

                                       

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="username">Client ID</label>
                                                <input required type="text" value="{{old('username')}}"  name="username" id="username" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter Client Id'" class="form-control" >
                                                @if ($errors->has('username'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('username') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="password">Client Password</label>
                                                <input required type="password" value="{{old('password')}}"  name="password" id="password" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter password'" class="form-control" >
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('password') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="role_id">Role </label>
                                                <select required name="role_id" id="role_id" class="form-control custom-select">
                                                   <option value="">Select Role</option>
                                                   @foreach($roles as $role)
                                                        <option {{ (2 == $role->id ? 'selected' : '' ) }} value="{{$role->id}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('role_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('role_id') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="head-label">
                                                    <label class="switch-box" style="top:-12px;">Status</label>
                                                    
                                                        <div class="custom-control custom-switch">
                                                          <input name="status" {{ (old('status') == 'on') ? 'checked' : '' }} type="checkbox" class="custom-control-input" id="status">
                                                          <label class="custom-control-label" for="status">Publish/Unpublish</label>
                                                        </div>
                                                   
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>


                            
                        </div><hr>
                        <div class="form-actions pull-right">
                            <button type="submit"  name="submit" value="save" class="btn btn-success"> <i class="fa fa-save"></i> Save </button>
                            
                            <button type="reset" class="btn waves-effect waves-light btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
               
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->


   
@endsection

@section('js')
   
    <script src="{{asset('assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>

    <script type="text/javascript">

        @if(old('district'))
            get_upzilla({{old('district')}});
        @endif

        function get_upzilla(id=0){
           
            var  url = '{{route("get_upzilla", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#upzilla").html(data);
                         $("#upzilla").focus();
                    }else{
                        $("#upzilla").html('<option>Upzilla not found</option>');
                    }
                }
            });
        }        
        @if(old('zone'))
            get_subzone({{old('zone')}});
        @endif
        function get_subzone(id=0){
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
        }        

        @if(old('package_id'))
            get_package_details({{old('package_id')}});
        @endif

        function get_package_details(id=null){
            var  url = '{{route("package.details", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                   
                    if(data.status){
                        document.getElementById('bandwidth').value = data.bandwidth;
                        document.getElementById('amount').value = data.amount;
                       
                    }else{
                        document.getElementById('bandwidth').value = '';
                        document.getElementById('amount').value = '';
                       
                    }
                }
            });
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

