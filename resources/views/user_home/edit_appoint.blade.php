@extends('layouts.master')
@section('content')
    <div class="container mt-4">
        <div>
            @if ($errors->any())
               <div class="alert alert-danger">
               <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
           </ul>
        </div>
        @endif
        <h1>Edit the Appointment</h1>
 
        <form id="appointmentForm" action="{{ route('update_appointment', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label for="title" class="col-sm-2 col-form-label">Appointment Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value='{{ $appointment->title }}''>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description" value='{{$appointment->description}}'>{{$appointment->description}}</textarea>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="start_date" class="col-sm-2 col-form-label">Start Date and Time</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" min="{{ now()->format('Y-m-d\TH:i') }}"
                        value='{{ $appointment->start_date }}'>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="end_date" class="col-sm-2 col-form-label">End Date and Time</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" min="{{ now()->format('Y-m-d\TH:i') }}"
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
                <label for="customer_id" class="col-sm-2 col-form-label">Customer</label>
                <div class="col-sm-10">
                    <select class="form-select" id="customer_id" name="customer_id">
                        <option value="">{{ $appointment->customer->name }}</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->email }}</option>
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
            <button type="submit" id='add-customer-form' class="btn btn-primary">Edit Appointment
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
 