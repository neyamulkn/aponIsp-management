@extends('layouts.master')
@section('title', 'Edit Package')

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
                                <li class="breadcrumb-item active">Edit</li>
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

                            <div class="card-body">
                                <form action="{{route('package.update', $data->id)}}" method="POST" class="floating-labels">
                                    {{csrf_field()}}
                                    <div class="form-body">
                                        <input type="hidden" value="{{$data->id}}" name="id">

                                        <!--/row-->
                                        <div class="row justify-content-md-center">

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="pkg_name">Package Name</label>
                                                    <input  name="pkg_name" id="pkg_name" value="{{$data->pkg_name}}" placeholder="Enter package name..." required="" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="bandwidth">Package bandwidth/speed/mb</label>
                                                    <input  name="bandwidth" id="bandwidth" value="{{$data->bandwidth}}" required="" placeholder="Enter bandwidth/speed/mb ..." type="text" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="price">Package price</label>
                                                    <input  name="price" id="price" value="{{$data->price}}" required="" type="number" placeholder="Enter price ..." class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="discount">Package discount</label>
                                                    <input  name="discount" id="discount" value="{{$data->discount}}" placeholder="Enter discount ..." required="" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label style="background: #fff;top:-10px;z-index: 1" for="details">Add details</label>
                                                    <textarea name="details" class=" form-control" rows="5" id="details" placeholder="Enter details ...">{{$data->details}}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label style="background: #fff;top:-10px;z-index: 1" for="connection_type">Connection_type</label>
                                                    <select name="connection_type" class=" form-control" rows="5" id="connection_type" >
                                                        <option {{($data->connection_type == 'ppoe' ? 'selected' : '')}} value="ppoe">PPOE</option>
                                                        <option {{($data->connection_type == 'wifi' ? 'selected' : '')}} value="wifi">HotSpot/wifi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-8">
                                                <div class="head-label">
                                                    <label class="switch-box" style="top:-12px;">Status</label>
                                                    <div  class="status-btn" >
                                                        <div class="custom-control custom-switch">
                                                            <input name="status" checked  type="checkbox" class="custom-control-input" {{($data->status == 1) ?  'checked' : ''}} id="status">
                                                            <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                    <button type="button" class="btn btn-inverse">Cancel</button>
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
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>

@endsection
