@extends('layouts.app')

@section('content')

@inject('commonHelper', 'App\Helpers\CommonHelper')
@inject('str', 'Illuminate\Support\Str')
@php
    $user = Auth::user();
    $roles = $commonHelper::getRoles();
    $cities = $commonHelper::getCities();
    $states = $commonHelper::getStates();
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
                                                <h5>Add Employee</h5>
                                            </div>
                                            <div class="card-block">
                                                <form class="form-material" action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                        <h4>Personal Details</h4>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group form-default">
                                                                            <label class="col-form-label">First Name</label>
                                                                            <input type="text" name="first_name" value="{{ old('first_name') }}">
                                                                            
                                                                            @error('first_name')
                                                                                <span class="invalid-feedback" style="display: block;">
                                                                                    {{ $message }}
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group form-default">
                                                                            <label class="col-form-label">Last Name</label>
                                                                            <input type="text" name="last_name" value="{{ old('last_name') }}">
                                                                            
                                                                            @error('last_name')
                                                                                <span class="invalid-feedback" style="display: block;">
                                                                                    {{ $message }}
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group form-default">
                                                                            <label class="col-form-label">Email</label>
                                                                            <input type="text" name="email" value="{{ old('email') }}">
                                                                            
                                                                            @error('email')
                                                                                <span class="invalid-feedback" style="display: block;">
                                                                                    {{ $message }}
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <div class="form-group form-default">
                                                                            <label class="col-form-label">Password</label>
                                                                            <input type="text" name="password" value="{{ old('password') }}">
                                                                            
                                                                            @error('password')
                                                                                <span class="invalid-feedback" style="display: block;">
                                                                                    {{ $message }}
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group form-default">
                                                                            <label class="col-form-label">Date of Birth</label>
                                                                            <input type="text" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="YYYY-MM-DD">
                                                                            <div class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-th"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-9">
                                                                        <h5 class="col-form-label" style="font-weight: 100;">Roles </h5>
                                                                        
                                                                        @foreach($roles as $role)
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="checkbox" name="roles[]" id="{{ $str::slug($role->name, '_') }}" value="{{ $role->id }}" {{ in_array($role->id, (old('roles') ?? [])) ? 'checked' : '' }}/>
                                                                                <label class="form-check-label" for="{{ $str::slug($role->name, '_') }}">{{ $role->name }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                        
                                                                        @error('roles')
                                                                            <span class="invalid-feedback" style="display: block;">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4 class="sub-title">Image</h4>
                                                                <input type="file" name="image">
                                                                <!--<img src="{{ asset('storage/images/users/avatar.jpg') }}" class="img-radius" alt="">-->
                                                                
                                                                @error('image')
                                                                    <span class="invalid-feedback" style="display: block;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        
                                                        <h4>Address</h4>
                                                        <h5 class="col-form-label" style="font-weight: 100;">Is Current & Permanent Address same?</h5>
                                                        
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input is_address_same" type="radio" name="is_address_same" id="is_address_same_yes" value="1" {{ (int)old('is_address_same') === 1 ? 'checked' : '' }}/>
                                                            <label class="form-check-label" for="is_address_same_yes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input is_address_same" type="radio" name="is_address_same" id="is_address_same_no" value="0" {{ (int)old('is_address_same') === 0 ? 'checked' : '' }}/>
                                                            <label class="form-check-label" for="is_address_same_no">No</label>
                                                        </div>
                                                        
                                                        @error('is_address_same')
                                                            <span class="invalid-feedback" style="display: block;">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                            
                                                        <h4 class="sub-title" style="margin-top: 30px;">Current Address</h4>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group form-default">
                                                                    <label class="col-form-label" style="display:block;">Address Line 1</label>
                                                                    <input type="text" name="current_address_line_one" value="{{ old('current_address_line_one') }}">
                                                                    
                                                                    @error('current_address_line_one')
                                                                        <span class="invalid-feedback" style="display: block;">
                                                                            {{ $message }}
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group form-default">
                                                                    <label class="col-form-label" style="display:block;">Address Line 2</label>
                                                                    <input type="text" name="current_address_line_two" value="{{ old('current_address_line_two') }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group form-default">
                                                                    <h5 class="col-form-label" style="font-weight: 100;">City </h5>
                                                                    <select class="select2" name="current_address_city">
                                                                        <option value="" disabled selected>Select City</option>
                                                                        @foreach($cities as $city)
                                                                        <option value="{{ $city->id }}" {{ (int)old('current_address_city') === $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    
                                                                    @error('current_address_city')
                                                                        <span class="invalid-feedback" style="display: block;">
                                                                            {{ $message }}
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group form-default">
                                                                    <h5 class="col-form-label" style="font-weight: 100;">State </h5>
                                                                    <select class="select2" name="current_address_state">
                                                                        <option value="" disabled selected>Select State</option>
                                                                        @foreach($states as $state)
                                                                            <option value="{{ $state->id }}" {{ (int)old('current_address_state') === $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    
                                                                    @error('current_address_state')
                                                                        <span class="invalid-feedback" style="display: block;">
                                                                            {{ $message }}
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="permanent_address_container" style="display: {{ (int)old('is_address_same') === 1 ? 'none' : 'block' }};">
                                                            <h4 class="sub-title">Permanent Address</h4>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group form-default">
                                                                        <label class="col-form-label" style="display:block;">Address Line 1</label>
                                                                        <input type="text" name="permanent_address_line_one" value="{{ old('permanent_address_line_one') }}">
                                                                        
                                                                        @error('permanent_address_line_one')
                                                                            <span class="invalid-feedback" style="display: block;">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group form-default">
                                                                        <label class="col-form-label" style="display:block;">Address Line 2</label>
                                                                        <input type="text" name="permanent_address_line_two" value="{{ old('permanent_address_line_two') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group form-default">
                                                                        <h5 class="col-form-label" style="font-weight: 100;">City </h5>
                                                                        <select class="select2" name="permanent_address_city">
                                                                            <option value="" disabled selected>Select City</option>
                                                                            @foreach($cities as $city)
                                                                                <option value="{{ $city->id }}" {{ (int)old('permanent_address_city') === $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        
                                                                        @error('permanent_address_city')
                                                                            <span class="invalid-feedback" style="display: block;">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group form-default">
                                                                        <h5 class="col-form-label" style="font-weight: 100;">State </h5>
                                                                        <select class="select2" name="permanent_address_state">
                                                                            <option value="" disabled selected>Select State</option>
                                                                            @foreach($states as $state)
                                                                                <option value="{{ $state->id }}" {{ (int)old('permanent_address_state') === $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        
                                                                        @error('permanent_address_state')
                                                                            <span class="invalid-feedback" style="display: block;">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <button type="submit" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>Save</button>
                                                    </form>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
        
        $('.is_address_same').on('change', (e) => {
            let _value = parseInt($(e.target).val());
            let _$permanentAddContainer = $('#permanent_address_container');
            _value === 1 ? _$permanentAddContainer.hide() :  _$permanentAddContainer.show();
        });
    });
</script>

@endsection
