@extends('layouts.master')
@section('title', 'Dashboard')
@section('css')
    <link href="{{ asset('assets/node_modules') }}/morrisjs/morris.css" rel="stylesheet">
    <!--Toaster Popup message CSS -->

    <link href="{{ asset('css') }}/pages/dashboard1.css" rel="stylesheet">
    <style type="text/css">.round{font-size:25px;}</style>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
      <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid dashboard1"><br/>
                
                <div class="row">
                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">TOTAL USERS</h5>
                            <div class="d-flex  no-block align-items-center">
                                <span class="display-5 text-info"><i class="icon-people"></i></span>
                                <a href="javscript:void(0)" class="link display-5 ml-auto">{{$total_users}}</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ACTIVE USERS</h5>
                            <div class="d-flex  no-block align-items-center">
                                <span class="display-5 text-purple"><i class="fa fa-user-plus"></i></span>
                                <a href="javscript:void(0)" class="link display-5 ml-auto">{{$active_users}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <!-- Column -->
                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">DEACTIVE USERS</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-danger"><i class="fa fa-user-times"></i></span>
                                <a href="javscript:void(0)" class="link display-5 ml-auto">{{$inactive_users}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <!-- Column -->
                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mikrotik Active Live user</h5>
                            <div class="d-flex  no-block align-items-center">
                                <span class="display-5 text-info"><i class="fa fa-user"></i></span>
                                <a href="javscript:void(0)" class="link display-5 ml-auto">{{$inactive_users}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="fa fa-sitemap"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">{{$packages}}</h3>
                                        <h5 class="text-muted m-b-0">TOTAL PACKAGES</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="fa fa-dollar-sign"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">$690</h3>
                                        <h5 class="text-muted m-b-0">TOTAL BILL</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="fa fa-handshake"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">$20</h3>
                                        <h5 class="text-muted m-b-0">COLLECTION BIL</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="fa fa-money-bill-alt"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">$6540</h3>
                                        <h5 class="text-muted m-b-0">DUES BILL</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            
                            <div class="card-body">
                                <h5 class="title_head">USERS</h5>
                                <table class="table browser">
                                    <tbody>
                                        <tr>
                                            
                                            <td>TOTAL</td>
                                            <td align="right"><span class="badge badge-pill badge-info">23%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>NEW</td>
                                            <td align="right"><span class="badge badge-pill badge-success">15%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>ACTIVE</td>
                                            <td align="right"><span class="badge badge-pill badge-primary">07%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>ONLINE</td>
                                            <td align="right"><span class="badge badge-pill badge-warning">09%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>ONLINE TADAY</td>
                                            <td align="right"><span class="badge badge-pill badge-danger">23%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>BLOCKED</td>
                                            <td align="right"><span class="badge badge-pill badge-cyan">09%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="title_head">TICKETS</h5>
                                <table class="table browser">
                                    <tbody>
                                        <tr>
                                            
                                            <td>TOTAL</td>
                                            <td align="right"><span class="badge badge-pill badge-info">23%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>NEW</td>
                                            <td align="right"><span class="badge badge-pill badge-success">15%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>WORK IN PROGRESS</td>
                                            <td align="right"><span class="badge badge-pill badge-primary">07%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>RESOLVED</td>
                                            <td align="right"><span class="badge badge-pill badge-warning">09%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>PENDING</td>
                                            <td align="right"><span class="badge badge-pill badge-danger">23%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>COMPLETE</td>
                                            <td align="right"><span class="badge badge-pill badge-cyan">09%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="title_head">BILLING/FINANCE</h5>
                                <table class="table browser">
                                    <tbody>
                                        <tr>
                                            
                                            <td>TOTAL TRANSACTIONS</td>
                                            <td align="right"><span >23%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>PAID INVOICES</td>
                                            <td align="right"><span>15%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>UNPAID INVOICES</td>
                                            <td align="right"><span>07%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>PAID REQUESTS</td>
                                            <td align="right"><span>09%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>UNPAID REQUESTS</td>
                                            <td align="right"><span>23%</span></td>
                                        </tr>
                                        <tr>
                                            
                                            <td>BLOCKED</td>
                                            <td align="right"><span>09%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>                
                
               
                <!-- ============================================================== -->
                <!-- End Info box -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Over Visitor, Our income , slaes different and  sales prediction -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex m-b-40 align-items-center no-block">
                                    <h5 class="card-title ">YEARLY INCOME</h5>
                                    <div class="ml-auto">
                                        <ul class="list-inline font-12">
                                            <li><i class="fa fa-circle text-cyan"></i> Client</li>
                                            <li><i class="fa fa-circle text-primary"></i> Router</li>
                                            <li><i class="fa fa-circle text-purple"></i> Stock</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="morris-area-chart" style="height: 340px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-4 col-md-12">
                        <div class="row">
                            <!-- Column -->
                            <div class="col-md-12">
                                <div class="card bg-cyan text-white">
                                    <div class="card-body ">
                                        <div class="row weather">
                                            <div class="col-6 m-t-40">
                                                <h3>&nbsp;</h3>
                                                <div class="display-4">73<sup>°F</sup></div>
                                                <p class="text-white">AHMEDABAD, INDIA</p>
                                            </div>
                                            <div class="col-6 text-right">
                                                <h1 class="m-b-"><i class="wi wi-day-cloudy-high"></i></h1>
                                                <b class="text-white">SUNNEY DAY</b>
                                                <p class="op-5">April 14</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-12">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <div id="myCarouse2" class="carousel slide" data-ride="carousel">
                                            <!-- Carousel items -->
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <h4 class="cmin-height">My Acting blown <span class="font-medium">Your Mind</span> and you also <br/>laugh at the moment</h4>
                                                    <div class="d-flex no-block">
                                                        <span><img src="../assets/images/users/1.jpg" alt="user" width="50" class="img-circle"></span>
                                                        <span class="m-l-10">
                                                    <h4 class="text-white m-b-0">Govinda</h4>
                                                    <p class="text-white">Actor</p>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <h4 class="cmin-height">My Acting blown <span class="font-medium">Your Mind</span> and you also <br/>laugh at the moment</h4>
                                                    <div class="d-flex no-block">
                                                        <span><img src="../assets/images/users/2.jpg" alt="user" width="50" class="img-circle"></span>
                                                        <span class="m-l-10">
                                                    <h4 class="text-white m-b-0">Govinda</h4>
                                                    <p class="text-white">Actor</p>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <h4 class="cmin-height">My Acting blown <span class="font-medium">Your Mind</span> and you also <br/>laugh at the moment</h4>
                                                    <div class="d-flex no-block">
                                                        <span><img src="../assets/images/users/3.jpg" alt="user" width="50" class="img-circle"></span>
                                                        <span class="m-l-10">
                                                    <h4 class="text-white m-b-0">Govinda</h4>
                                                    <p class="text-white">Actor</p>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
            
           
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
       
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
@endsection
@section('js')
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="{{ asset('assets/node_modules') }}/raphael/raphael-min.js"></script>
    <script src="{{ asset('assets/node_modules') }}/morrisjs/morris.min.js"></script>
    <script src="{{ asset('assets/node_modules') }}/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Popup message jquery -->
    <script src="{{ asset('assets/node_modules') }}/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    <script src="{{ asset('js') }}/dashboard1.js"></script>
   
@endsection