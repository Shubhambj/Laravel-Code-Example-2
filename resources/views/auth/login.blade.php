@extends('layouts.app')

@section('content')
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                    <form class="md-float-material form-material" method="post" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="text-center">
                            <img src="{{ asset('images/logo.png') }}" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Sign In</h3>
                                    </div>
                                </div>
                                
                                @if(Session::has('message'))
                                    <div class="alert alert-{{ Session::get('alert-type', 'alert-info') }}" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                    
                                <div class="form-group form-primary">
                                    <input type="text" name="email" class="form-control">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Your Email Address</label>
                                    
                                    @error('email')
                                        <span class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="form-group form-primary">
                                    <input type="password" name="password" class="form-control">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Password</label>
                                    
                                    @error('password')
                                        <span class="invalid-feedback" style="display: block;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">
                                            <label>
                                                <input type="checkbox" name="remember_me">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
<!--                                        <div class="forgot-phone text-right f-right">
                                            <a href="auth-reset-password.html" class="text-right f-w-600"> Forgot Password?</a>
                                        </div>-->
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
@endsection