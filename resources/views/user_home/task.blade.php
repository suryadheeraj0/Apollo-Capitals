@extends('layouts.master')
 
@section('content')
    <div class="container mt-4">
        <h1>Create a New Task</h1>
 
        <form action="{{ route('store.create_task') }}" method="POST" id="create-task-form">
            @csrf
            <div class="row mb-3">
                <label for="client_name" class="col-sm-2 col-form-label">User Name</label>
                <div class="col-sm-10">
                    <p>{{$user->name}}</p>
                </div>
            </div>
 
            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Enter Task</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="description" name="task">
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
                        name="due_date" required>
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
 

 
            <button type="submit" class="btn btn-primary">Create Task</button>
            <div class="mt-3">
                <a href="{{ route('back') }}" class="btn btn-secondary">Back</a>
            </div>
 
        </form>
    </div>
 
    <script>
        document.getElementById('create-task-form').addEventListener('submit', function() {
            alert("Task added successfully!");
        });
    </script>
@endsection
 
