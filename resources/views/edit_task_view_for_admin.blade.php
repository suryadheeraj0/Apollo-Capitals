@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Task</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Display validation errors if any -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form to edit the task -->
                    <form action="{{ route('update-task-for-admin', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task">Task Name</label>
                            <input type="text" name="task" class="form-control" id="task" value="{{ old('task', $task->task) }}" required>
                        </div>

                        <!-- Task Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <!-- Due Date -->
                        <div class="form-group">
                            <label for="due_date_time">Due Date</label>
                            <input type="datetime-local" name="due_date_time" class="form-control" id="due_date_time" value="{{ old('due_date_time', $task->due_date_time ? date('Y-m-d\TH:i', strtotime($task->due_date_time)) : '') }}" required>
                        </div>

                        <!-- Priority -->
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <select name="priority" class="form-control" id="priority" required>
                                <option value="1" {{ old('priority', $task->priority) === 'High' ? 'selected' : '' }}>High</option>
                                <option value="2" {{ old('priority', $task->priority) === 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="3" {{ old('priority', $task->priority) === 'Low' ? 'selected' : '' }}>Low</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update Task</button>
                        <!-- Cancel Button -->
                        <a href="{{ route('view-tasks-for-admin') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
