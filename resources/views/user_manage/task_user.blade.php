@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

            </div>
        @endif
        <h1>Search Users</h1>

    <!-- Search Form -->
    <div class="form-container">
        <form action="{{ route('users-search-task-creation') }}" method="GET">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
            <label for="date_from">From Date</label>
            <input type="date" id = "date_from" name="date_from" placeholder="From" value="{{ request('date_from') }}">
            <label for="date_to">To Date</label>
            <input type="date" name="date_to" id = "date_to" placeholder="To" value="{{ request('date_to') }}">

            <!-- Sorting Options -->
            <select name="sort_by">
                <option value="created_at" {{ $sortBy == 'created_at' ? 'selected' : '' }}>Sort by Date</option>
                <option value="name" {{ $sortBy == 'name' ? 'selected' : '' }}>Sort by Title</option>
                <option value="email" {{ $sortBy == 'email' ? 'selected' : '' }}>Sort by Priority</option>
                <option value="role" {{ $sortBy == 'role' ? 'selected' : '' }}>Sort by Status</option>
            </select>

            <select name="sort_direction">
                <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>

            <button type="submit">Search</button>
        </form>
    </div>




        <h1>User Task Management</h1>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Assigned Tasks</th>
                    <th>Task Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if (strtolower($user->role) === 'user')
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->tasks->isEmpty())
                                    Task not Assigned
                                @else
                                    <ul>
                                        @foreach ($user->tasks as $task)
                                            <li>{{ $task->task }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tasks.create', $user->id) }}" class='btn btn-primary'>Create Task</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{route('admin_dashboard')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
