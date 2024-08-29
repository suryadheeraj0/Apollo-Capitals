@extends('layouts.master')
 
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title">Edit Task</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('store.update_task', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="task" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="task" name="task" value="{{ $task->task }}"
                            required>
                    </div>
 
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ $task->description }}</textarea>
                    </div>
 
                    <div class="mb-3">
                        <label for="due_date_time" class="form-label">Due Date and Time</label>
                        <input type="datetime-local" class="form-control" id="due_date_time" name="due_date_time"
                            value="{{ \Carbon\Carbon::parse($task->due_date_time)->format('Y-m-d\TH:i') }}" required>
                    </div>
 
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-select" id="priority" name="priority" required>
                            <option value="1" {{ $task->priority === '1' ? 'selected' : '' }}>High</option>
                            <option value="2" {{ $task->priority === '2' ? 'selected' : '' }}>Medium</option>
                            <option value="3" {{ $task->priority === '3' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>
 
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1" {{ $task->status === '1' ? 'selected' : '' }}>Not Started</option>
                            <option value="2" {{ $task->status === '2' ? 'selected' : '' }}>In Progress</option>
                            <option value="3" {{ $task->status === '3' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
 
                    <div class='mb-3'>
                        <label for='assign_to' class='form-label'>Assign To</label>
                        <select class='form-select' id='assign_to' name='assign_to' optional>
                            <option value='None'>None</option>
                            @foreach ($users as $user)
                                @if ($user->role === 'user' && $user->id !== auth()->user()->id)
                                    <option value='{{ $user->id }}'
                                        {{ $task->assign_to == $user->id ? 'selected' : '' }}>
                                        {{ $user->email }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
 
                    <button type="submit" class="btn btn-success">Update Task</button>
                </form>
            </div>
        </div>
    </div>
@endsection
 