@extends('layouts.master')
 
@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h1 class="display-4">Manage Your Appointments</h1>
            <p class="lead">Hi <strong>{{ $user->name }}</strong>, welcome to the Appointment Management section. Here
                you can schedule and manage your appointments efficiently.</p>
        </div>
 
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Create a New Appointment</h3>
                    </div>
                    <div class="card-body">
                        <p>Click the button below to create a new appointment with your customers. Ensure all details are
                            accurate to avoid any scheduling conflicts.</p>
                        <a href="{{ route('create_customer_appointment') }}" class="btn btn-success btn-block">Create
                            Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 