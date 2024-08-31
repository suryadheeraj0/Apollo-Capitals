@extends('layouts.master')
 
@section('content')
@if(session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="container mt-5">
        <h2>Edit Customer</h2>
        <form action='{{ route('update_customer', $customer->id) }}' method='POST' class="mt-4">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="phone_number">Phone Number</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number"
                    value="{{ $customer->phone_number }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Edit Customer</button>
            @if (auth()->user()->role === "Admin")
                <a href="{{route('view-customers-for-admin')}}" class="btn-btn-danger">Back</a>
            @else
                <a href="{{route('create_cust1')}}" class="btn-btn-danger">Back</a>
            @endif
        </form>
    </div>
@endsection
 