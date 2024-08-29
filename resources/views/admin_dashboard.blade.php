@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Main Content -->
            <main role="main" class="col-md-12 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Admin Dashboard</h1>
                </div>

                <div class="row">
                    <!-- Task & Diary Management Section -->
                    <div class="col-md-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <h5 class="card-title mb-0">Task & Diary Management</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Manage tasks and diary entries to keep track of activities.</p>
                                <a href="{{route('view-tasks-for-admin')}}" class="btn btn-primary btn-sm">View Tasks</a>
                                <a href="{{route('users-search-task-creation')}}" class="btn btn-outline-primary btn-sm">Create a Task</a>
                            </div>
                        </div>
                    </div>

                    <!-- User Management Section -->
                    <div class="col-md-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <h5 class="card-title mb-0">User Management</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Create new users and manage existing user details.</p>
                                <a href="{{route('users.search')}}" class="btn btn-secondary btn-sm">View Users</a>
                                <a href="{{route('createUser')}}" class="btn btn-outline-secondary btn-sm">Create a New User</a>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Management Section -->
                    <div class="col-md-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <h5 class="card-title mb-0">Appointment Management</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Manage appointments with clients and stakeholders.</p>
                                <a href="{{route('view-appointments-for-admin')}}" class="btn btn-success btn-sm">View Appointments</a>
                                <a href="{{route('create_customer_appointment')}}" class="btn btn-outline-success btn-sm">Create an Appointment</a>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Management Section -->
                    <div class="col-md-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-header bg-success text-dark">
                                <h5 class="card-title mb-0">Customer Management</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Manage customer leads and view existing customer information.</p>
                                <a href="{{route('view-customers-for-admin')}}" class="btn btn-warning btn-sm">View Customers</a>
                                <a href="{{route('create_cust_data1')}}" class="btn btn-outline-warning btn-sm">Create a New Lead</a>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Log Section -->
                    <div class="col-md-12 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <h5 class="card-title mb-0">Roles & Permissions Management</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Create and Modify new Roles and Perissions on the platform.</p>
                                <a href="{{route('roles.index')}}" class="btn btn-danger btn-sm">Roles & Permissions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div>
            <a href="{{route('home')}}" class="btn-btn-danger">Back</a>
        </div>
    </div>
@endsection
