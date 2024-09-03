@extends('layouts.master')

@section('content')
<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif



    <h1>Search Appointments</h1>

    <!-- Search Form -->
    <div class="form-container">
        <form action="{{ route('get-search-results-for-appointments') }}" method="GET">
            @csrf
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
            <label for="date_from">From Date</label>
            <input type="date" id = "date_from" name="date_from" placeholder="From" value="{{ request('date_from') }}">
            <label for="date_to">To Date</label>
            <input type="date" name="date_to" id = "date_to" placeholder="To" value="{{ request('date_to') }}">

            <!-- Sorting Options -->
            <select name="sort_by">
                <option value="created_at" {{ $sortBy == 'created_at' ? 'selected' : '' }}>Sort by Date</option>
                <option value="title" {{ $sortBy == 'title' ? 'selected' : '' }}>Sort by Title</option>
                <option value="attendees" {{ $sortBy == 'priority' ? 'selected' : '' }}>Sort by attendees</option>
            </select>

            <select name="sort_direction">
                <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>

            <button type="submit">Search</button>
        </form>
    </div>

    <h1 class="text-center mb-4">All Appointments</h1>
    <div class="row">
        @foreach($appointments as $appointment)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $appointment->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            Customer Name: {{ $appointment->customer->name }}<br>
                            User Name: {{ $appointment->user->name }}
                        </h6>
                        <p class="card-text"><strong>Description:</strong> {{ $appointment->description }}</p>
                        <p class="card-text"><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($appointment->start_date)->format('d M Y, H:i') }}</p>
                        <p class="card-text"><strong>End Date:</strong> {{ \Carbon\Carbon::parse($appointment->end_date)->format('d M Y, H:i') }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $appointment->location }}</p>
                        <p class="card-text"><strong>Attendees:</strong> {{ $appointment->attendees }}</p>
                        <p class="card-text"><strong>Recurrence:</strong> {{ $appointment->recurrence ? $appointment->recurrence : 'None' }}</p>
                        <a href="{{route('show-edit-form-to-edit-appointment-admin', $appointment->id)}}" class="btn btn-primary mt-2">Edit Appointment</a>
                        <form action="{{route('delete-appointment-admin', $appointment->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        Created at: {{ \Carbon\Carbon::parse($appointment->created_at)->format('d M Y, H:i') }}
                    </div>
                </div>
            </div>
        @endforeach
        <div>
            {{$appointments->links()}}
        </div>
        <a href="{{route('admin_dashboard')}}" class="btn-btn-danger">Back</a>
    </div>
</div>
@endsection
