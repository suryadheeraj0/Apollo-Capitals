@extends('layouts.master')
 
@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Appointments</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Attendees</th>
                    <th>Associated Task</th>
                    <th>Assigned Customer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->title }}</td>
                        <td>{{ $appointment->start_date }}</td>
                        <td>{{ $appointment->end_date }}</td>
                        <td>{{ $appointment->attendees }}</td>
                        <td>
                            @if ($appointment->task)
                                {{ $appointment->task->task }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if ($appointment->customer)
                                {{ $appointment->customer->name }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href='{{ route('edit_appointment', $appointment->id) }}'
                                    class="btn btn-primary btn-sm">Edit</a>
                                <form action='{{ route('delete_appointment', $appointment->id) }}' method='POST'>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn"
                                        id="delete-{{ $appointment->id }}">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        <a href="{{ route('back') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
