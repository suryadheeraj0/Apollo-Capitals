@extends('layouts.master')

@section('content')
<div class="container mt-5">


    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif


    <h1>Search Tasks</h1>

    <!-- Search Form -->
    <div class="form-container">
        <form action="{{ route('get-search-tasks-results') }}" method="GET">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
            <label for="date_from">From Date</label>
            <input type="date" id = "date_from" name="date_from" placeholder="From" value="{{ request('date_from') }}">
            <label for="date_to">To Date</label>
            <input type="date" name="date_to" id = "date_to" placeholder="To" value="{{ request('date_to') }}">

    
            <!-- Priority Filter -->
            <label for="priority">Priority</label>
            <select name="priority" id="priority">
                <option value="">Select Priority</option>
                <option value="1" {{ request('priority') == '1' ? 'selected' : '' }}>High</option>
                <option value="2" {{ request('priority') == '2' ? 'selected' : '' }}>Medium</option>
                <option value="3" {{ request('priority') == '3' ? 'selected' : '' }}>Low</option>
            </select>

            <!-- Status Filter -->
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="">Select Status</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Not Started</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>In Progress</option>
                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>completed</option>
            </select>

            <!-- Sorting Options -->
            <select name="sort_by">
                <option value="created_at" {{ $sortBy == 'created_at' ? 'selected' : '' }}>Sort by Date</option>
                <option value="task" {{ $sortBy == 'title' ? 'selected' : '' }}>Sort by Task</option>
                <option value="priority" {{ $sortBy == 'priority' ? 'selected' : '' }}>Sort by Priority</option>
                <option value="status" {{ $sortBy == 'status' ? 'selected' : '' }}>Sort by Status</option>
            </select>

            <select name="sort_direction">
                <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>

            <button type="submit">Search</button>
        </form>
    </div>



    <h2 class="text-center mb-4">All Tasks</h2>
    <div class="row">
        @foreach($tasks as $task)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->task }}</h5>
                        <p class="card-text">
                            <strong>Assigned To:</strong> {{ $task->user->name ?? 'Not Assigned' }}<br>
                            <strong>Priority:</strong> 
                            @if ($task->priority == "1")
                                High
                            @elseif ($task->priority == "2")
                                Medium 
                            @else
                                Low 
                            @endif
                            
                            <br>
                            <strong>Status:</strong>
                            @if ($task->status == "1")
                                Not Started
                            @elseif ($task->status == "2")
                                In Progress
                            @else
                                Completed
                            @endif
                             <br>
                            <strong>Due Date:</strong> {{ \Carbon\Carbon::parse($task->due_date_time)->format('d M, Y h:i A') }}<br>
                            <strong>Description:</strong> {{ $task->description ?? 'No Description Provided' }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('edit-task-form-admin', $task->id) }}" class="btn btn-sm btn-primary">Edit Task</a>
                            <form action="{{ route('delete-task', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete Task</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        Created on: {{ \Carbon\Carbon::parse($task->created_at)->format('d M, Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {{$tasks->links()}}
    </div>
    <a href="{{route('admin_dashboard')}}" class="btn-btn-danger">Back</a>
</div>
@endsection
