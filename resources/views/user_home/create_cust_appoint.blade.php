@extends('layouts.master')
 
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Hi {{ $user->name }}, welcome to Appointments</h1>
 
        <a href="#" class="btn btn-primary mb-3">Create Appointment</a>
 
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Customer Name</th>
                        <th>Appointment Date</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointment as $appointment)
                        <tr>
                            <td>{{ $appointment->customer_name }}</td>
                            <td>{{ $appointment->appointment_data }}</td>
                            <td>{{ $appointment->details }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
 
