@extends('layouts.master')
@section('title', 'Add tj')
@section('css')
    <style type="text/css">
        #TJ label{margin-bottom: -5px;}
        .core-list select option{
            color:#fff; padding:15px !important; text-shadow: 1px 1px 3px #000 !important;
        }

        .point-title{
            font-size: 20px; font-weight: 600;  color: #fb9678;

        }

    @media screen and (min-width: 640px) {
        .connectBtn{padding: 50px 0px}
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
                    <h4 class="text-themecolor">Tj Connection</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                       
                        <a href="{{route('tj')}}" class="btn btn-info btn-sm d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> TJ List</a>
                        <button data-toggle="modal" data-target="#categoryModal" class="btn btn-success btn-sm d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add Category</button>
                        <button data-toggle="modal" data-target="#brand" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add Brand</button>
                        <button data-toggle="modal" data-target="#shop" class="btn btn-primary btn-sm d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add Shop</button>
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

                    <div class="form-body">
                        <div class="title_head">
                            TJ Connection
                        </div>
                      
                        @foreach($TjConnections as $TjConnection)

                        <form  action="{{route('tj.connectionStore', $TjConnection->tj_id)}}" method="POST" id="item{{$TjConnection->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="TjConnection_id" value="{{$TjConnection->id}}">
                            <div class="row justify-content-md-center" id="TJ">
                                <div class="col-12 col-md-4">
                                    <div class="col-12"><span class="point-title">Start Point</span></div>

                                    <div class="row  justify-content-md-center">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="required" for="fiber_start">Select Fiber</label>
                                                <select onchange="get_core(this.value, 'start_{{$TjConnection->id}}')" required name="fiber_start" id="fiber_start" class="form-control custom-select">
                                                <option value="">Select one</option>
                                                @foreach($fibers as $fiber)
                                                    <option @if($TjConnection->fiber_start == $fiber->id) selected @endif value="{{$fiber->id}}">{{$fiber->fiber_name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-9 core-list" id="show_core_start_{{$TjConnection->id}}">
                                            @if($TjConnection->get_fiber_start)
                                           
                                            <div class="form-group">
                                                <label class="required" for="core_start">Select Core </label>
                                                <select onchange="get_extend_core(this.value, 'start_{{$TjConnection->id}}')"  name="core_start" style="width:100%; background:  {{ $TjConnection->connect_core_start->core_color}};color:#fff;text-shadow: 1px 1px 3px #000" id="core_start" class="form-control custom-select">
                                                  
                                                    @foreach ($TjConnection->get_fiber_start->cores as $core)
                                                       <option  @if($TjConnection->core_start == $core->id) selected @else {!! ($core->core_status == 1 && $core->extend_core == null ? 'disabled title="This core allready used"' : ''  ) !!} @endif style="background:{{$core->core_color}}" value="{{$core->id}}"> Core {{$core->core_no}}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                              @endif
                                        </div>
                                      
                                       
                                        <div class="col-md-9 core-list" id="show_extend_core_start_{{$TjConnection->id}}">
                                            @if($TjConnection->get_spliter_start)
                                            <div class="form-group">
                                                <label class="required">{{$TjConnection->get_spliter_start->spliter_name}}</label>
                                                <input type="hidden" name="extend_spliter_start" value="{{$TjConnection->get_spliter_start->id}}">
                                                <select name="extend_spliter_core_start" style="width:100%; background:  {{ $TjConnection->connect_extend_core_start->core_color}};color:#fff;text-shadow: 1px 1px 3px #000"  class="form-control custom-select">
                                                   
                                                    @foreach ($TjConnection->get_spliter_start->cores as $core)
                                                        <option @if($TjConnection->extend_spliter_core_start == $core->id) selected  @endif style="background:{{$core->core_color}}" value="{{$core->id}}"> Core {{$core->core_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endif
                                        </div>
                                      
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="fiber_miter_start">Fiber Miter No</label>
                                                <input name="fiber_miter_start" value="{{$TjConnection->fiber_miter_start}}" id="fiber_miter_start" type="text" placeholder="Enter miter no" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="start_details">Details</label>
                                                <input value="{{$TjConnection->details_start}}" name="details_start" id="start_details" type="text" placeholder="Enter details" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="col-12 col-md-2 connectBtn">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                               <label for="start_details">Connection Type</label>
                                                <select onchange="get_connect_type(this.value, 'connect{{$TjConnection->id}}')" required name="connect_type" id="connect_type" class="form-control custom-select">
                                                    <option @if($TjConnection->connect_type == 'fiber') selected @endif value="fiber">Fiber</option>
                                                    <option  @if($TjConnection->connect_type == 'onu') selected @endif value="onu">Onu</option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                        
                                            <select required name="connectBy" id="connectBy" class="form-control custom-select">
                                                <option value="">Connect By</option>
                                               @foreach($staffs as $staff)
                                                <option @if($TjConnection->connectBy == $staff->id) selected @endif value="{{$staff->id}}">{{$staff->name}}</option>
                                                @endforeach
                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12"><button style="width: 100%" class="btn btn-success">Connected</button></div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="col-12"><span class="point-title">Out Point</span></div>
                                   
                                    <div class="row justify-content-md-center" id="show_connect_fieldconnect{{$TjConnection->id}}">
                                        @if($TjConnection->connect_type == 'fiber')
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="required" for="fiber_out">Select Fiber</label>
                                                <select required onchange="get_core(this.value, 'out_{{$TjConnection->id}}')" name="fiber_out" id="fiber_out" class="form-control custom-select">
                                                <option value="">Select one</option>
                                                @foreach($fibers as $fiber)
                                                    <option @if($TjConnection->fiber_out == $fiber->id) selected @endif value="{{$fiber->id}}">{{$fiber->fiber_name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-9 core-list" id="show_core_out_{{$TjConnection->id}}">
                                            @if($TjConnection->get_fiber_out)
                                            <div class="form-group">
                                                <label class="required" for="core_out">Select Core </label>
                                                <select onchange="get_extend_core(this.value, 'out_{{$TjConnection->id}}')"  name="core_out" style="width:100%; background:  {{ $TjConnection->connect_core_out->core_color}};color:#fff;text-shadow: 1px 1px 3px #000" id="core_out" class="form-control custom-select">
                                                    
                                                    @foreach ($TjConnection->get_fiber_out->cores as $core)
                                                       <option  @if($TjConnection->core_out == $core->id) selected @else {!! ($core->core_status == 1 && $core->extend_core == null ? 'disabled title="This core allready used"' : '' ) !!} @endif style="background:{{$core->core_color}}" value="{{$core->id}}"> Core {{$core->core_no}}</option>';
                                                    @endforeach
                                                    
                                            </select>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-9 core-list" id="show_extend_core_out_{{$TjConnection->id}}">
                                            @if($TjConnection->get_spliter_start)
                                            <div class="form-group">
                                                <label class="required">{{$TjConnection->get_spliter_start->spliter_name}}</label>
                                                <input type="hidden" name="extend_spliter_out" value="{{$TjConnection->get_spliter_start->id}}">
                                                <select name="extend_spliter_core_out" style="width:100%; background:  {{ $TjConnection->connect_extend_core_out->core_color}};color:#fff;text-shadow: 1px 1px 3px #000"  class="form-control custom-select">
                                                   
                                                    @foreach ($TjConnection->get_spliter_out->cores as $core)
                                                        <option @if($TjConnection->extend_spliter_core_out == $core->id) selected  @endif @if($core->core_status == 1 && $core->extend_core == null) disabled title="This core allready used" @endif style="background:{{$core->core_color}}" value="{{$core->id}}"> Core {{$core->core_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="required" for="fiber_miter_out">Fiber Miter No</label>
                                                <input  name="fiber_miter_out" value="{{$TjConnection->fiber_miter_out}}" id="fiber_miter_out" type="text" placeholder="Enter miter no" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="details_out">Details</label>
                                                <input  name="details_out" value="{{$TjConnection->details_out}}" placeholder="Enter details" id="details_out" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="required" for="fiber">Select TJ</label>
                                                 <select required name="join_tj" id="join_tj" class="form-control custom-select">
                                                <option value="">Select one</option>
                                                @foreach($alltj as $tj)
                                                    <option @if($TjConnection->join_tj == $tj->id) selected @endif value="{{$tj->id}}">{{$tj->tj_name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @else
                                         <div class="col-md-9"> <div class="form-group"><label class="required" for="onu_mac">Unu Mac</label><input required name="onu_mac" value="{{ $TjConnection->onu_mac}}" id="onu_mac" type="text" placeholder="Enter Mac" class="form-control"></div></div>
                                         <div class="col-md-9"><div class="form-group"><label class="required" for="box">Select Box</label> <select name="box" id="box" class="form-control custom-select"><option value="">Select Box</option>@foreach($boxs as $box)<option @if($TjConnection->box == $box->id) selected @endif value="{{$box->id}}">{{$box->name}}</option>@endforeach</select></div></div>
                                         <div class="col-md-9"><div class="form-group"><label class="required" for="user">Select User</label><select name="user" id="user" class="form-control custom-select"> <option value="">Select user</option>@foreach($users as $user)<option @if($TjConnection->user == $user->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>@endforeach</select></div></div>
                                         <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="details_out">Details</label>
                                                <input value="{{$TjConnection->details_out}}" name="details_out" id="start_details" type="text" placeholder="Enter details" class="form-control">
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-1" style="margin: auto; margin-left: 0;"><button type="button"data-target="#delete" onclick="deleteConfirmPopup('{{route("tj.connectionDelete", $TjConnection->id)}}')" data-toggle="modal" class="btn btn-danger"><i class="fa fa-times"></i> Delete </button></div>
                            </div>
                        </form><hr/>

                        @endforeach

                        <form  action="{{route('tj.connectionStore', $get_tj->id)}}" method="POST" >
                        {{csrf_field()}}
                       
                            <div class="row justify-content-md-center" id="TJ">
                                <div class="col-12 col-md-4">
                                    
                                    <div class="col-12"><span class="point-title">Start Point</span></div>
                                    <div class="row  justify-content-md-center">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="required" for="fiber_start">Select Fiber</label>
                                                <select onchange="get_core(this.value, 'start')" required name="fiber_start" id="fiber_start" class="form-control custom-select">
                                                <option value="">Select one</option>
                                                @foreach($fibers as $fiber)
                                                    <option value="{{$fiber->id}}">{{$fiber->fiber_name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-9 core-list" id="show_core_start"></div>
                                        <div class="col-md-9 core-list" id="show_extend_core_start"></div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="fiber_miter_start">Fiber Miter No</label>
                                                <input  name="fiber_miter_start" id="fiber_miter_start" type="text" placeholder="Enter miter no" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="start_details">Details</label>
                                                <input  name="details_start" id="start_details" type="text" placeholder="Enter details" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-12 col-md-2 connectBtn">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                               <label for="start_details">Connection Type</label>
                                                <select onchange="get_connect_type(this.value, 'first')" required name="connect_type" id="connect_type" class="form-control custom-select">
                                                    <option value="fiber">Fiber</option>
                                                    <option value="onu">Onu</option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                        
                                            <select required name="connectBy" id="connectBy" class="form-control custom-select">
                                                <option value="">Connect By</option>
                                               @foreach($staffs as $staff)
                                                <option value="{{$staff->id}}">{{$staff->name}}</option>
                                                @endforeach
                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12"><button style="width: 100%" class="btn btn-danger">Connect</button></div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="col-12"><span class="point-title">Out Point</span></div>
                                   
                                    <div class="row justify-content-md-center" id="show_connect_fieldfirst">
                                        
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="required" for="fiber_out">Select Fiber</label>
                                                <select required onchange="get_core(this.value, 'out')" name="fiber_out" id="fiber_out" class="form-control custom-select">
                                                <option value="">Select one</option>
                                                @foreach($fibers as $fiber)
                                                    <option value="{{$fiber->id}}">{{$fiber->fiber_name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-9 core-list"  id="show_core_out"></div>
                                        <div class="col-md-9 core-list" id="show_extend_core_out"></div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="required" for="fiber_miter_out">Fiber Miter No</label>
                                                <input  name="fiber_miter_out" id="fiber_miter_out" type="text" placeholder="Enter miter no" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="details_out">Details</label>
                                                <input  name="details_out" placeholder="Enter details" id="details_out" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="required" for="fiber">Select TJ</label>
                                                 <select required name="join_tj" id="join_tj" class="form-control custom-select">
                                                <option value="">Select one</option>
                                                @foreach($alltj as $tj)
                                                    <option value="{{$tj->id}}">{{$tj->tj_name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1" style="margin: auto; margin-left: 0;"><button type="button" onclick="getextraConnectCore()" class="btn btn-info"><i class="fa fa-plus"></i> Add</button></div>
                            </div>
                        </form><hr/>
                        <div id="extraConnectCore"></div>
                        <div class="row justify-content-md-center"><div class="col-md-4"><span onclick="getextraConnectCore()" class="btn btn-info" style="cursor: pointer;"><i class="fa fa-plus"></i> Add More Connection </span></div></div>
                       
                    </div>
                
                </div>
               
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- delete Modal -->
    @include('admin.modal.delete-modal')


@endsection

@section('js')

<script>
    function get_core(id, type){
        if(typeof id != 'undefined' || id != null){
            var  url = '{{route("get_core", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                data:{type:type},
                success:function(data){
                  
                    if(data){
                        $("#show_core_"+type).html(data);
                         $("#show_extend_core_"+type).html('');
                        
                    }else{
                        $("#show_core_"+type).html('');
                        $("#show_extend_core_"+type).html('');
                    }
                }
            });
        }else{
            $("#show_core_"+type).html('');
             $("#show_extend_core_"+type).html('');
        }
    }          

    function get_extend_core(id, type){
       
        if(typeof id != 'undefined' || id != null){
           
            var  url = '{{route("get_extend_core", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                data:{type:type},
                success:function(data){
                  
                    if(data){
                        $("#show_extend_core_"+type).html(data);
                        
                    }else{
                        $("#show_extend_core_"+type).html('');
                    }
                }
            });
        }else{
            $("#show_extend_core_"+type).html('');
        }
    }    
   
    function get_connect_type(type, field){
        
        if(type == 'fiber'){
            var output = ' <div class="col-md-9"> <div class="form-group">  <label class="required" for="fiber_out">Select Fiber</label> <select required onchange="get_core(this.value, \''+field+'\')" name="fiber_out" id="fiber_out" class="form-control custom-select"> <option value="">Select one</option> @foreach($fibers as $fiber) <option value="{{$fiber->id}}">{{$fiber->fiber_name}}</option> @endforeach </select> </div> </div>  <div class="col-md-9 core-list"  id="show_core_'+field+'"></div><div class="col-md-9 core-list" id="show_extend_core_'+field+'"></div><div class="col-md-9"> <div class="form-group"> <label class="required" for="fiber_miter_out">Fiber Miter No</label> <input  name="fiber_miter_out" id="fiber_miter_out" placeholder="Enter miter no" type="text" class="form-control"> </div> </div> <div class="col-md-9"> <div class="form-group"> <label for="details_out">Details</label> <input  name="details_out" placeholder="Enter details" id="details_out" type="text" class="form-control"> </div> </div> <div class="col-md-9">  <div class="form-group"> <label class="required" for="fiber">Select TJ</label> <select required name="join_tj" id="join_tj" class="form-control custom-select"> <option value="">Select one</option>  @foreach($alltj as $tj) <option value="{{$tj->id}}">{{$tj->tj_name}}</option> @endforeach </select> </div> </div>';
        }else{
            var output = ' <div class="col-md-9"> <div class="form-group"><label class="required" for="onu_mac">Unu Mac</label><input required name="onu_mac" id="onu_mac" type="text" placeholder="Enter Mac" class="form-control"></div></div><div class="col-md-9"><div class="form-group"><label class="required" for="box">Select Box</label> <select name="box" id="box" class="form-control custom-select"><option value="">Select Box</option>@foreach($boxs as $box)<option value="{{$box->id}}">{{$box->name}}</option>@endforeach</select></div></div><div class="col-md-9"><div class="form-group"><label class="required" for="user">Select User</label><select name="user" id="user" class="form-control custom-select"> <option value="">Select user</option>@foreach($users as $user)<option value="{{$user->id}}">{{$user->name}}</option>@endforeach</select></div></div><div class="col-md-9"> <div class="form-group"> <label for="details_out">Details</label> <input  name="details_out" placeholder="Enter details" id="details_out" type="text" class="form-control"> </div> </div> '
        }
        $('#show_connect_field'+field).html(output);
    }   
   
</script>
    <script type="text/javascript">

    var extraConnectCore = 1;
    //add dynamic attribute value fields by attribute
    function getextraConnectCore() {

        extraConnectCore++;
        var objTo = document.getElementById('extraConnectCore')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass" + extraConnectCore);
        var rdiv = 'removeclass' + extraConnectCore;
        
        divtest.innerHTML = '<form  action="{{route("tj.connectionStore", $get_tj->id)}}" method="POST" >{{csrf_field()}}<div class="row justify-content-md-center" id="TJ"><div class="col-12 col-md-4"><div class="row  justify-content-md-center"><div class="col-md-9"><div class="form-group"><label class="required" for="fiber_start">Select Fiber</label><select onchange="get_core(this.value,  \'start'+extraConnectCore+'\')" required name="fiber_start" id="fiber_start" class="form-control custom-select"><option value="">Select one</option>@foreach($fibers as $fiber)<option value="{{$fiber->id}}">{{$fiber->fiber_name}}</option>@endforeach</select></div></div><div class="col-md-9 core-list" id="show_core_start'+extraConnectCore+'"></div><div class="col-md-9 core-list" id="show_extend_core_start'+extraConnectCore+'"></div><div class="col-md-9"><div class="form-group"><label for="fiber_miter_start">Fiber Miter No</label><input  name="fiber_miter_start" id="fiber_miter_start" type="text" placeholder="Enter miter no" class="form-control"></div></div><div class="col-md-9"><div class="form-group"><label for="start_details">Details</label><input  name="details_start" id="start_details" type="text" placeholder="Enter details" class="form-control"></div></div></div></div><div class="col-12 col-md-2 connectBtn"><div class="col-md-12"><div class="form-group"><label for="start_details">Connection Type</label><select onchange="get_connect_type(this.value, \'out'+extraConnectCore+'\')" required name="connect_type" id="connect_type" class="form-control custom-select"><option value="fiber">Fiber</option><option value="onu">Onu</option></select></div></div><div class="col-md-12"><div class="form-group"><select required name="connectBy" id="connectBy" class="form-control custom-select"><option value="">Connect By</option>@foreach($staffs as $staff)<option value="{{$staff->id}}">{{$staff->name}}</option>@endforeach</select></div></div><div class="col-md-12"><button style="width: 100%" class="btn btn-danger">Connect</button></div></div><div class="col-12 col-md-4"><div class="row justify-content-md-center" id="show_connect_fieldout'+extraConnectCore+'"><div class="col-md-9"><div class="form-group"><label class="required" for="fiber_out">Select Fiber</label><select required onchange="get_core(this.value, \'out'+extraConnectCore+'\')" name="fiber_out" id="fiber_out" class="form-control custom-select"><option value="">Select one</option>@foreach($fibers as $fiber)<option value="{{$fiber->id}}">{{$fiber->fiber_name}}</option>@endforeach</select></div></div><div class="col-md-9 core-list"  id="show_core_out'+extraConnectCore+'"></div><div class="col-md-9 core-list" id="show_extend_core_out'+extraConnectCore+'"></div><div class="col-md-9"><div class="form-group"><label class="required" for="fiber_miter_out">Fiber Miter No</label><input  name="fiber_miter_out" id="fiber_miter_out" type="text" placeholder="Enter miter no" class="form-control"></div></div><div class="col-md-9"><div class="form-group"><label for="details_out">Details</label><input  name="details_out" placeholder="Enter details" id="details_out" type="text" class="form-control"></div></div><div class="col-md-9"><div class="form-group"><label class="required" for="fiber">Select TJ</label><select required name="join_tj" id="join_tj" class="form-control custom-select"><option value="">Select one</option>@foreach($alltj as $tj)<option value="{{$tj->id}}">{{$tj->tj_name}}</option>@endforeach</select></div></div></div></div><div class="col-12 col-md-1" style="margin: auto; margin-left: 0;"><button class="btn btn-danger" type="button" onclick="remove_extraConnectCore('+extraConnectCore+');"><i class="fa fa-times"></i> Remove</button></div></div></form><hr/>';
        objTo.appendChild(divtest)
             
       
    }
    //remove dynamic extra field
    function remove_extraConnectCore(rid) {
        $('.removeclass' + rid).remove();
    }

</script>
  

@endsection

