@extends('layouts.app')

@section('content')

@php
    $user = Auth::user();
@endphp
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('dashboard') }}">
                            <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            
                            <li class="user-profile header-notification">
                                <a href="#" class="waves-effect waves-light">
                                    <img src="{{ asset('storage/images/users/avatar.jpg') }}" class="img-radius" alt="">
                                    <span>{{ ucfirst($user->first_name) }}</span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li class="waves-effect waves-light">
                                        <a href="{{ route('auth.logout') }}">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-80 img-radius" src="{{ asset('storage/images/users/avatar.jpg') }}">
                                    <div class="user-details">
                                        <span id="more-details">{{ ucwords($user->first_name.' '.$user->last_name) }}</span>
                                    </div>
                                </div>
                            </div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li>
                                    <a href="{{ route('dashboard') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                        <!--<span class="pcoded-mcaret"></span>-->
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Employees</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="{{ route('employee.list') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        <span class="pcoded-mtext">Employee</span>
                                        <!--<span class="pcoded-mcaret"></span>-->
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Dashboard</h5>
                                            <p class="m-b-0">Welcome to Stock Management</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Employee Details</h5>
                                            </div>
                                            <div class="card-block">

                                                <h4>Personal Details</h4>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group form-default">
                                                                    <label class="col-form-label">First Name</label>
                                                                    <input type="text" name="first_name" value="{{ $employee->first_name }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group form-default">
                                                                    <label class="col-form-label">Last Name</label>
                                                                    <input type="text" name="last_name" value="{{ $employee->last_name }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group form-default">
                                                                    <label class="col-form-label">Email</label>
                                                                    <input type="text" name="email" value="{{ $employee->email }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group form-default">
                                                                    <label class="col-form-label">Date of Birth</label>
                                                                    <input type="text" name="date_of_birth" value="{{ $employee->dob }}" disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <h5 class="col-form-label" style="font-weight: 100;">Roles </h5>

                                                                @foreach($employee->roles as $role)
                                                                    <div class="form-check form-check-inline">
                                                                        <label class="form-check-label">{{ $role->name }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h4 class="sub-title">Image</h4>
                                                        <img src="{{ asset('storage/images/users/'.$employee->image) }}" height="150" width="150" class="img-radius">
                                                    </div>
                                                </div>
                                                
                                                @if(!empty($employee->addresses))
                                                    <h4>Address</h4>
                                                    <h5 class="col-form-label" style="font-weight: 100;">Is Current & Permanent Address same?</h5>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input is_address_same" type="radio" name="is_address_same" id="is_address_same_yes" value="1" {{ $employee->is_address_same === 1 ? 'checked' : '' }} disabled/>
                                                        <label class="form-check-label" for="is_address_same_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input is_address_same" type="radio" name="is_address_same" id="is_address_same_no" value="0" {{ $employee->is_address_same === 0 ? 'checked' : '' }} disabled/>
                                                        <label class="form-check-label" for="is_address_same_no">No</label>
                                                    </div>
                                                    
                                                    @foreach($employee->addresses as $address)
                                                    <h4 class="sub-title" style="margin-top: 30px;">{{ $address->type ? 'Current' : 'Permanent' }} Address</h4>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group form-default">
                                                                <label class="col-form-label" style="display:block;">Address Line 1</label>
                                                                <input type="text" name="current_address_line_one" style="width: 300px;" value="{{ $address->line_one }}" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group form-default">
                                                                <label class="col-form-label" style="display:block;">Address Line 2</label>
                                                                <input type="text" name="current_address_line_two" style="width: 300px;" value="{{ $address->line_two }}" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group form-default">
                                                                <label class="col-form-label" style="display:block;">City</label>
                                                                <input type="text" name="current_address_line_two" style="width: 300px;" value="{{ $address->cityName }}" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group form-default">
                                                                <label class="col-form-label" style="display:block;">State</label>
                                                                <input type="text" name="current_address_line_two" style="width: 300px;" value="{{ $address->stateName }}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif        
                                                
                                                <a href="{{ route('employee.list') }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-arrow-left-3"><i class="icofont-arrow-left"></i></i>Back</a>  
                                            </div>
                                        </div>
                                    </div>        
                                        
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
