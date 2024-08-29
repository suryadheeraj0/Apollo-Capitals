@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Appointment</h1>
    

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif


    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $appointment->title) }}" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $appointment->description) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', \Carbon\Carbon::parse($appointment->start_date)->format('Y-m-d\TH:i')) }}" required>
        </div>
        
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', \Carbon\Carbon::parse($appointment->end_date)->format('Y-m-d\TH:i')) }}" required>
        </div>
        
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $appointment->location) }}">
        </div>
        
        <div class="form-group">
            <label for="attendees">Attendees</label>
            <input type="text" class="form-control" id="attendees" name="attendees" value="{{ old('attendees', $appointment->attendees) }}">
        </div>
        
        <div class="form-group">
            <label for="recurrence">Recurrence</label>
            <select class="form-control" id="recurrence" name="recurrence">
                <option value="" {{ old('recurrence', $appointment->recurrence) == '' ? 'selected' : '' }}>None</option>
                <option value="Daily" {{ old('recurrence', $appointment->recurrence) == 'Daily' ? 'selected' : '' }}>Daily</option>
                <option value="Weekly" {{ old('recurrence', $appointment->recurrence) == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="Monthly" {{ old('recurrence', $appointment->recurrence) == 'Monthly' ? 'selected' : '' }}>Monthly</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Appointment</button>
        <a href="{{ route('view-appointments-for-admin') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
