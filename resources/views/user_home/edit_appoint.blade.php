@extends('layouts.master')
@section('content')
    <div class="container mt-4">
        <h1>Edit the Appointment</h1>
 
        <form id="appointmentForm" action="{{ route('update_appointment', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label for="title" class="col-sm-2 col-form-label">Appointment Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value='{{ $appointment->title }}'
                        required>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="start_date" class="col-sm-2 col-form-label">Start Date and Time</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" required
                        value='{{ $appointment->start_date }}'>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="end_date" class="col-sm-2 col-form-label">End Date and Time</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" required
                        value='{{ $appointment->end_date }}'>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="location" class="col-sm-2 col-form-label">Location</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="location" name="location"
                        value='{{ $appointment->location }}'>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="attendees" class="col-sm-2 col-form-label">Attendees</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="attendees" name="attendees"
                        value='{{ $appointment->attendees }}'>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="recurrence" class="col-sm-2 col-form-label">Recurrence</label>
                <div class="col-sm-10">
                    <select class="form-select" id="recurrence" name="recurrence">
                        <option value="none">{{ $appointment->recurrence }}</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="customer_id" class="col-sm-2 col-form-label">Customer</label>
                <div class="col-sm-10">
                    <select class="form-select" id="customer_id" name="customer_id" required>
                        <option value="">{{ $appointment->customer->name }}</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="task_id" class="col-sm-2 col-form-label">Task</label>
                <div class="col-sm-10">
                    <select class="form-select" id="task_id" name="task_id">
                        <option value="">{{ $appointment->task->task }}</option>
                        @foreach ($tasks as $task)
                            <option value="{{ $task->id }}">{{ $task->task }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" id='add-customer-form' class="btn btn-primary">Create Appointment
            </button>
        </form>
        <div class="mt-3">
            <a href="{{ route('back') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
 
@section('scripts')
    <script>
        document.getElementById('add-customer-form').addEventListener('submit', function() {
            alert("Customer added successfully!");
        });
    </script>
@endsection
 