
@extends('layouts.app')
@section('title', 'Login | Multi Vendor Ecommere site')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-center">Admin Sign In</div>

                <div class="card-body">
                      <!-- ============================================================== -->
                        <form class="m-t-20" id="loginform" action="{{route('adminLogin')}}" method="post">
                        @csrf
                       
                            <div class="form-group">
                               
                                <label>Username or Email</label>
                                <input name="usernameOrEmail" value="{{old('usernameOrEmail')}}" class="form-control" type="text" required="">
                                <span class="bar"></span>
                                @if ($errors->has('usernameOrEmail'))
                                    <span class="" role="alert">
                                        {{ $errors->first('usernameOrEmail') }}
                                    </span>
                                @endif
                            
                            </div>
                        
                       
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label>Password</label>
                                <input name="password" class="form-control" type="password" required="" > 
                                <span class="bar"></span>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                       {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <div class="custom-control-label" for="customCheck1">Remember me</div>
                                    </div> 
                                    <div class="ml-auto">
                                        <a href="javascript:void(0)" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i> Forgot pwd?</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log In</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                <div class="social">
                                    <button class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fab fa-facebook-f"></i> </button>
                                    <button class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fab fa-google-plus-g"></i> </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Don't have an account? <a href="{{route('register')}}" class="text-info m-l-5"><b>Sign Up</b></a>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" id="recoverform" action="index.html">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
