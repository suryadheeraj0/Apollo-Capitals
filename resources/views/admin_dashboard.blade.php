@extends('layouts.master')
 
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <h4 class="sidebar-heading">Admin Dashboard</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link active" href="{{ route('get_users') }}">
                                <i class="bi bi-person"></i> User Management
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                <i class="bi bi-shield-lock"></i> Role Assignment
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
 
            <!-- Main Content -->
            <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Admin Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
 
                        </div>
                    </div>
                </div>
 
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Manage Users</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Access and manage user accounts, including viewing details and editing
                                    information.</p>
                                <a href="{{ route('get_users') }}" class="btn btn-primary">Show Users</a>
                            </div>
                        </div>
                    </div>
 
                    <div class="col-md-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Manage Roles</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Assign and update roles for users to manage their permissions and
                                    access levels.</p>
                                <a href="{{ route('admin.index') }}" class="btn btn-secondary">Assign Roles</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection