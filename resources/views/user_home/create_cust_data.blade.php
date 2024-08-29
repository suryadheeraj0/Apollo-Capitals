@extends('layouts.master')
 
@section('content')
    <div class="container mt-5">
        <div>
            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="text-center">
            <h1 class="display-4">Add New Customer</h1>
            <p class="lead">Fill in the details below to add a new customer to the system.</p>
        </div>
 
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Customer Information</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customers.store') }}" method="POST" id="add-customer-form">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter customer name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email address">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Enter phone number">
                            </div>
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter address">
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Add Customer</button>
                        </form>
                        <div class="mt-3">
                            @if (auth()->user()->role === 'Admin')
                                <a href="{{ route('admin_dashboard') }}" class="btn btn-secondary">Back</a>
                            @else
                                <a href="{{ route('back') }}" class="btn btn-secondary">Back</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
   
@endsection
 