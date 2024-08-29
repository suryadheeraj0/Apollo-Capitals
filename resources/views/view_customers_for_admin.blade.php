@extends('layouts.master')

@section('content')
@if(session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message') }}
</div>
@endif
    <div class="container mt-5">
        <h2 class="text-center mb-4">Customer Management</h2>
        <div class="row">
            @foreach ($customers as $customer)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $customer->name }}</h5>
                            <p class="card-text">
                                <strong>Email:</strong> {{ $customer->email }}<br>
                                <strong>Phone:</strong> {{ $customer->phone_number }}<br>
                                <strong>Address:</strong> {{ $customer->address }}<br>
                                <strong>Created By:</strong> {{ $customer->user->name ?? 'N/A' }}<br>
                                <strong>Task ID:</strong> {{ $customer->task_id }}
                            </p>
                            <p class="text-muted mb-1">Created At: {{ $customer->created_at->format('d M Y, h:i A') }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="{{route('delete_customer', $customer->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <form action="{{route('edit_customer', $customer->id)}}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{route('admin_dashboard')}}" class="btn-btn-danger">Back</a>
    </div>
@endsection
