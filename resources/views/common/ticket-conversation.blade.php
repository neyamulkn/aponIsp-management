@extends('layouts.master')
@section('title', ($get_ticket) ? 'Ticket | '. $get_ticket->title : 'Ticket Conversation')
@section('css-top')
 <link href="{{asset('css')}}/pages/chat-app-page.css" rel="stylesheet">
 <style type="text/css">
    .conversation-head{padding: 6px 10px 6px; background: linear-gradient(180deg, #dedede, #e6e4e4);color: #fff;}
    .conversation-head a{color: #000;}
    .conversation-head small{display: block;margin-top: -3px;}

    .chatonline span{position: relative;}
    .online, .offline {position: absolute;height: 14px;width: 14px;border-radius: 50%;bottom: -15px;left: -20px;border: 1.5px solid white;}

    .online{ background-color: #4cd137;}
    .offline{ background-color: #ddd;}
    .chatonline .active{background: #f7f7f7;}
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
                        <h4 class="text-themecolor">Ticket Conversation</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Ticket</a></li>
                                <li class="breadcrumb-item active">Conversation</li>
                            </ol>
                            <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
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
                    <div class="col-12">
                        <div class="card m-b-0">
                            <!-- .chat-row -->
                            <div class="chat-main-box">
                                <!-- .chat-left-panel -->
                                <div class="chat-left-aside">
                                    <div class="open-panel"><i class="ti-angle-right"></i></div>
                                    <div class="chat-left-inner" style="height: 360px;">
                                        <div class="form-material">
                                            <input class="form-control p-2" type="text" placeholder="Search Ticket">
                                        </div>
                                        <ul class="chatonline style-none ">
                                            @foreach($active_tickets as $active_ticket)
                                            <li class="{{ ($active_ticket->id == $get_ticket->id) ? 'active' : '' }}">
                                                <a href="{{route('ticket.conversation', $active_ticket->slug)}}">
                                                    <img src="{{asset('upload/users/avatars/'.$active_ticket->user->phato)}}" alt="user-img" class="img-circle"> 
                                                    <span>{{$active_ticket->user->name}}  
                                                        <small>{!! ($active_ticket->single_conversation) ? $active_ticket->single_conversation->conversation : ''!!}</small>
                                                        
                                                        <small class="{{ ($active_ticket->user->isOnline()) ? 'online' : 'offline' }}"></small>
                                                        
                                                    </span>
                                                </a>
                                            </li>
                                            @endforeach
                                            
                                            <li class="p-20"></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- .chat-left-panel -->
                                <!-- .chat-right-panel -->
                                <div class="chat-right-aside">
                                    @if($get_ticket)
                                    <div class="chat-main-header">
                                        <div class="chatonline conversation-head">
                                            <a href=""><img src="{{asset('assets')}}/images/users/2.jpg" alt="user-img" class="img-circle"> 
                                            <span>{{$get_ticket->user->name}} 
                                                <small> 
                                                @if(($active_ticket->user->isOnline()))Active Now
                                                <small class="online"></small>@else Offline @endif </small> 
                                            </span></a>
                                        </div>
                                    </div>
                                    <div class="chat-rbox">
                                        <ul class="chat-list p-3">
                                            
                                            @foreach($get_ticket->ticket_conversation as $conversation)
                                            <!--chat Row -->
                                            @if($conversation->from_user == Auth::id())
                                            
                                            <li class="reverse">
                                                <div class="chat-content">
                                                    <h5>{{$conversation->user->name}} @if($get_ticket->user_id == $conversation->user->id)<sup>Author</sup>@endif</h5>
                                                    <div class="box bg-light-inverse">{!!$conversation->conversation!!}</div>
                                                    <div class="chat-time">{{ \Carbon\Carbon::parse($conversation->ticket_date)->diffForHumans()}}</div>
                                                </div>
                                                <div class="chat-img"><img src="{{asset('assets')}}/images/users/5.jpg" alt="user" /></div>
                                            </li>
                                            @else
                                            <!--chat Row -->
                                            <li>
                                                <div class="chat-img"><img src="{{asset('assets')}}/images/users/1.jpg" alt="user" /></div>
                                                <div class="chat-content">
                                                    <h5>{{$conversation->user->name}} @if($get_ticket->user_id == $conversation->user->id)<sup>Author</sup>@endif</h5>
                                                    <div class="box bg-light-info">{!!$conversation->conversation!!}</div>
                                                    <div class="chat-time">{{ \Carbon\Carbon::parse($conversation->ticket_date)->diffForHumans()}}</div>
                                                </div>
                                            </li>
                                            @endif
                                            <!--chat Row -->
                                            @endforeach
                                           
                                        </ul>
                                    </div>
                                    <div class="card-body border-top">
                                        <form action="{{route('ticket.conversation.store')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="ticket_id" value="{{ $get_ticket->id }}">
                                            <div class="row">
                                                <div class="col-8">
                                                    <textarea name="conversation" placeholder="Type your message here" class="form-control border-0"></textarea>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <button type="submit" class="btn btn-info btn-circle btn-lg"><i class="fas fa-paper-plane"></i> </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                                <!-- .chat-right-panel -->
                            </div>
                            <!-- /.chat-row -->
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

@endsection
