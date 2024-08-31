@extends('layouts.master')
 
@section('content')
    <div class="container mt-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


        <!-- Search Form -->
    <div class="form-container">
        <form action="{{ route('userTasks.results') }}" method="GET">
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
                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Completed</option>
            </select>

            <!-- Sorting Options -->
            <select name="sort_by">
                <option value="created_at" {{ $sortBy == 'created_at' ? 'selected' : '' }}>Sort by Date</option>
                <option value="title" {{ $sortBy == 'title' ? 'selected' : '' }}>Sort by Title</option>
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







        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title">Tasks Assigned to User</h1>
            </div>
            <div class="card-body">
                <p class="lead">Hello {{ auth()->user()->name }}, here are your assigned tasks:</p>
                @if ($tasks->isEmpty())
                    <div class="alert alert-info" role="alert">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @else
                            No Tasks assigned for you 
                        @endif
                    </div>
                @else
                    {{-- <form method="GET" action="{{ route('store.sort_task') }}" class="mb-4">
                        <div class="form-group">
                            <label for="sort_by">Sort By:</label>
                            <select name="sort_by" id="sort_by" class="form-select">
                                <option value="1" {{ request('sort_by') == '1' ? 'selected' : '' }}>Due Date</option>
                                <option value="2" {{ request('sort_by') == '2' ? 'selected' : '' }}>Priority</option>
                                <option value="3" {{ request('sort_by') == '3' ? 'selected' : '' }}>Status</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary mt-2">Sort</button>
                    </form> --}}
 
 
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Assigned Task</th>
                                <th>Task Description</th>
                                <th>Due Date</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->task }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->due_date_time }}</td>
                                    <td>
                                        @if ($task->priority === "1")
                                            <span class="badge bg-success">High</span>
                                        @elseif($task->priority === "2")
                                            <span class="badge bg-warning text-dark">Medium</span>
                                        @else
                                            <span class="badge bg-danger">Low</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($task->status === "1")
                                            <span class="badge bg-secondary">Not Started</span>
                                        @elseif($task->status === "2")
                                            <span class="badge bg-info">In Progress</span>
                                        @else
                                            <span class="badge bg-success">Completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href='{{ route('store.edit_task', $task->id) }}'
                                                class="btn btn-sm btn-warning me-2">Edit</a>
                                            <form action="{{ route('store.delete_task', $task->id) }}" method='POST'>
                                                @csrf
                                                @method('DELETE')
                                                <button class='btn btn-sm btn-danger'>Delete Task</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                <div class="mt-3">
                    <a href="{{ route('back') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
 
