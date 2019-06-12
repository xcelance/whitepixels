@extends('layouts.app_new')

@section('meta_title', 'Register: AvoRed E commerce')
@section('meta_description', 'Register to Manage your Account for AvoRed E Commerce')
@section('slider')
        <div class="registration-banner inner-banner">
            <div class="container">
                <div class="banner-heading">
                    <h2>Customer Registration</h2>
                </div>
            </div>
        </div>
@endsection
@section('breadcums')
        <div class="breadcrumb-block">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login or Register</li>
                    </ol>
                </nav>
            </div>
        </div>

@endsection
@section('content')
  <section class="login-register-sec">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="continue-login-box ">
                            <h4>Login To Continue</h4>
                            <p>Please login with your quinnstheprinters.com account details below.</p>
                             <div class="login_msg"></div>
                            <form method="POST" action="{{ url('login_ajax') }}" class="login_form">
                              {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" id="username" name="username" class="form-control" aria-describedby="emailHelp" placeholder="Username">
                                </div>
                       
                                <div class="form-group">
                                    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                                <input type="hidden" name="onorder" value="1">                                
                                <input type="hidden" name="order_id" value="<?php echo $_GET['id']; ?>">

                                <div class="login-register-btn">
                                    <button type="submit" class="ct-btn">Login</button>
                                </div>
                            </form>
                            
                            <span class="or-block">or</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="signin-guest-box">
                            <h4>Sign in as a guest</h4>
                            <p>Automatically ensures you will receive email confirmations for orders and dispatch, but won't give you access to our special discounts.</p>     
                            <div class="login-register-btn">
                                <a href="{{url('guest_login?process=order&id=')}}<?php echo $_GET['id']; ?>"><button type="submit" class="ct-btn" >Sign in as guest</button></a>
                            </div>
                        </div>
                    </div>
                    
                     <div class="col-md-12">
                        <div class="signin-guest-box login-register-box">
                            <p>If you don't have a login, register with whitepixels.net to unlock special discounts and turnaround times across all our products.</p>     
                            <div class="login-register-btn">
                                <a href="{{url('register')}}"><button type="submit" class="ct-btn">Register</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
}
  
@endsection
