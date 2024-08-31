@extends('layouts.master')
 
@section('content')
    <div class="container mt-4">
        <div>
            @if ($errors->any())
                @foreach ($errors as $error)
                    {{$error}}
                @endforeach
            @endif
        </div>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title">Edit Task</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('store.update_task', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{--
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-select" id="priority" name="priority" required>
                            <option value="1" {{ $task->priority === '1' ? 'selected' : '' }}>High</option>
                            <option value="2" {{ $task->priority === '2' ? 'selected' : '' }}>Medium</option>
                            <option value="3" {{ $task->priority === '3' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>--}}
 
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1" {{ $task->status === '1' ? 'selected' : '' }}>Not Started</option>
                            <option value="2" {{ $task->status === '2' ? 'selected' : '' }}>In Progress</option>
                            <option value="3" {{ $task->status === '3' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
 
                    <button type="submit" class="btn btn-success">Update Task</button>
                </form>
            </div>
        </div>
    </div>
@endsection
 