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
                                        @if(Session::has('message'))
                                    <div class="alert alert-{{ Session::get('alert-type', 'alert-info') }}" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                        
                                        <!-- Hover table card start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Employee</h5>
                                                <span>Employee List</span>
                                                <div class="card-header-right">
                                                    <a href="{{ route('employee.create') }}" class="btn waves-effect waves-light btn-primary">
                                                        Add Employee
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    @if(!empty($employees))
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>First Name</th>
                                                                    <th>Last Name</th>
                                                                    <th>Email</th>
                                                                    <th>DOB</th>
                                                                    <th>Image</th>
                                                                    <th>Roles</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($employees as $index => $employee)
                                                                    <tr>
                                                                        <th scope="row">{{ $index+1 }}</th>
                                                                        <td>{{ $employee->first_name }}</td>
                                                                        <td>{{ $employee->last_name }}</td>
                                                                        <td>{{ $employee->email }}</td>
                                                                        <td>{{ $employee->dob }}</td>
                                                                        <td>
                                                                            <img src="{{ asset('storage/images/users/'.$employee->image) }}" width="100" height="100"/>
                                                                        </td>
                                                                        <td>
                                                                            @forelse($employee->roles as $role)
                                                                                {{ $role->name }}</br>
                                                                            @empty
                                                                                &nbsp;
                                                                            @endforelse
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{ route('employee.show', ['id' => $employee->id]) }}" class="btn waves-effect waves-light btn-info" style="padding: 5px 5px 5px 10px; color: #fff !important;">
                                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                                            </a>
                                                                            <a href="{{ route('employee.edit', ['id' => $employee->id]) }}" class="btn waves-effect waves-light btn-primary" style="padding: 5px 5px 5px 10px; color: #fff !important;">
                                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                                            </a>
                                                                            @php
                                                                                $dbRoles = [];
                                                                                foreach($employee->roles as $role) {
                                                                                    $dbRoles[] = $role->id;
                                                                                } 
                                                                            @endphp
                                                                            @if(!in_array(1, $dbRoles))
                                                                            <form action="{{ route('employee.destroy', ['id' => $employee->id]) }}" method="POST">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="submit" class="btn waves-effect waves-light btn-danger" style="padding: 5px 5px 5px 10px; color: #fff !important;">
                                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                                </button>
                                                                            </form>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Hover table card end -->
                                        
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
