<!-- resources/views/user_manage/create_page.blade.php -->
@extends('layouts.master')
 
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-4">
        <h2>Create Tasks for {{ $user->name }}</h2>
 
        <form action="{{ route('tasks.store1', $user->id) }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
 
            <div id="task-container">
                <div class="form-group">
                    <label for="task-1">Task</label>
                    <input type="text" name="task" class="form-control" placeholder="Enter task">
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="due_date" class="col-sm-2 col-form-label">Due Date and Time</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control @error('due_date') is-invalid @enderror" id="due_date"
                        name="due_date" min="{{ now()->format('Y-m-d\TH:i') }}" required>
                    @error('due_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="priority" class="col-sm-2 col-form-label">Priority</label>
                <div class="col-sm-10">
                    <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority"
                        required>
                        <option value="">Select Priority</option>
                        <option value="1">High</option>
                        <option value="2">Medium</option>
                        <option value="3">Low</option>
                    </select>
                    @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
 
           
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div>
            <a href="{{route('admin_dashboard')}}" class="btn btn-danger">Back</a>
        </div>
    </div>
 
    <script>
        document.getElementById('add-task').addEventListener('click', function() {
            var container = document.getElementById('task-container');
            var index = container.children.length + 1;
            var newTask = document.createElement('div');
            newTask.className = 'form-group';
            newTask.innerHTML = `
            <label for="task-${index}">Task ${index}</label>
            <input type="text" name="tasks[]" class="form-control" placeholder="Enter task">
        `;
            container.appendChild(newTask);
        });
    </script>
@endsection
 
