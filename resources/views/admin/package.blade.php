@extends('layouts.master')
@section('title', 'Add Package')

@section('content')
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
                        <h4 class="text-themecolor">Add Package</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Package</a></li>
                                <li class="breadcrumb-item active">create</li>
                            </ol>
                            <a href="{{route('package.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Package List</a>
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
                            <div class="title_head">
                                User Information
                            </div>

                            <div class="card-body">
                                <form action="{{route('package.store')}}" method="POST" class="floating-labels">
                                    {{csrf_field()}}
                                    <div class="form-body">

                                        <!--/row-->
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required" for="pkg_name">Package Name</label>
                                                    <input  name="pkg_name" id="pkg_name" value="{{old('pkg_name')}}" placeholder="Enter package name..." required="" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required" for="bandwidth">Package bandwidth/speed/mb</label>
                                                    <input  name="bandwidth" id="bandwidth" value="{{old('bandwidth')}}" required="" placeholder="Enter bandwidth/speed/mb ..." type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required" for="download_speed">Download speed (kbps)</label>
                                                    <input  name="download_speed" id="download_speed" value="{{old('download_speed')}}" required="" placeholder="Enter download speed" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required" for="upload_speed">Upload speed (kbps)</label>
                                                    <input  name="upload_speed" id="upload_speed" value="{{old('upload_speed')}}" required="" placeholder="Enter upload speed" type="text" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required" for="price">Package price</label>
                                                    <input  name="price" id="price" value="{{old('price')}}" required="" type="number" placeholder="Enter price ..." class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="discount">Package discount</label>
                                                    <input  name="discount" id="discount" value="{{old('discount')}}" placeholder="Enter discount ..." type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label style="background: #fff;top:-10px;z-index: 1" for="details">Add details</label>
                                                    <textarea name="details" class=" form-control" rows="2" id="details" placeholder="Enter details ..."></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="required" style="background: #fff;top:-10px;z-index: 1" for="connection_type">Connection_type</label>
                                                    <select name="connection_type" class=" form-control" rows="5" id="connection_type" >
                                                        <option value="ppoe">PPOE</option>
                                                        <option value="wifi">HotSpot/wifi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <div class="head-label">
                                                    <label class="switch-box">Status</label>
                                                    <div  class="status-btn" >
                                                        <div class="custom-control custom-switch">
                                                            <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="status">
                                                            <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                        </div>
                                        <div class="form-actions pull-left">
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                    <button type="button" class="btn btn-inverse">Cancel</button>
                                                </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>

@endsection
