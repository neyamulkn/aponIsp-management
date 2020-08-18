@extends('layouts.master')
@section('title', 'Add staff')
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
                    <h4 class="text-themecolor">Add New staff</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                                <li class="breadcrumb-item active">create</li>
                            </ol>
                        <a href="{{route('staff.list')}}" class="btn btn-info btn-sm d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Staff List</a>
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
                    <form action="{{route('staff.store')}}" enctype="multipart/form-data" class="floating-labels" method="post" id="staff">
                        @csrf

                        <div class="form-body">
                            <div class="title_head">
                                Staff Information
                            </div>
                            <div class="row">
                                <div class="col-md-8 divrigth_border">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="name">Name</label>
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
                                                <label class="required" for="mobile">Mobile</label>
                                                <input type="text" value="{{old('mobile')}}" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter mobile number'" name="mobile" required="" id="mobile" class="form-control" >
                                                @if ($errors->has('mobile'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('mobile') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="email">Email</label>
                                                <input type="email" value="{{old('email')}}" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter email address'" name="email" required="" id="email" class="form-control" >
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="salary">Salary Amount</label>
                                                <input type="number" value="{{old('salary')}}" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter salary amount'" name="salary" required="" id="salary" class="form-control" >
                                                @if ($errors->has('salary'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('salary') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                       

                                        <div class="col-md-6">
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
                                        

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="birthday" class="control-label">Birthday date</label>
                                                <input name="birthday" id="birthday" value="{{old('birthday')}}" onblur="(this.type='text')" onfocus="(this.type='date')"  type="date" class="form-control">
                                                @if ($errors->has('birthday'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('birthday') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                           <div class="form-group">
                                                <label for="join_date">Join Date</label>
                                                <input onfocus="(this.type='date')" onblur="(this.type='text')" type="date" id="join_date"  value="{{old('join_date') ? old('join_date') : Carbon\Carbon::parse(now())->format('Y-m-d h:m:i')}}"  name="join_date" class="form-control">
                                            </div>
                                        </div>

                                        

                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="background: #fff;top:-10px;z-index: 1" for="user_dsc">Details</label>
                                                <textarea name="user_dsc" class="form-control" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter details'" id="user_dsc" rows="1">{{old('user_dsc')}}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="designation">Designation Select</label>
                                                <select required="" name="designation" id="designation" class="form-control custom-select">
                                                   <option value="">Select designation</option>
                                                   @foreach($designations as $designation)
                                                   <option {{ (old('designation') == $designation->designation ? 'selected' : '' ) }} value="{{$designation->designation}}">{{$designation->designation}}</option>
                                                   @endforeach
                                                   
                                                </select>
                                                @if ($errors->has('designation'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('designation') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="zone">Zone Select</label>
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

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="subzone">Sub Zone Select</label>
                                                <select required="required" name="subzone"  id="subzone" class="form-control custom-select">
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
                                            <div class="form-group"> <label class="dropify_image">Attach Image</label>
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
                                Account Information
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">

                                       

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="staffname">Username</label>
                                                <input required type="text" value="{{old('username')}}"  name="username" id="username" onblur="this.placeholder = ''" onfocus="this.placeholder = 'Enter username'" class="form-control" >
                                                @if ($errors->has('username'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('username') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="password">Password</label>
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
                                                        <option {{ (3 == $role->id ? 'selected' : '' ) }} value="{{$role->id}}">{{$role->name}}</option>
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
                                                    <label class="switch-box">Status</label>
                                                    
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

