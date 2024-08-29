@extends('layouts.master')
 
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Edit User Tasks</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="user-name">User Name</label>
                    <p id="user-name">{{ $user->name }}</p>
                </div>
 
                <div class="form-group">
                    <label for="user-email">User Email</label>
                    <p id="user-email">{{ $user->email }}</p>
                </div>
 
                <form action="{{ route('tasks.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
 
                    <div id="task-container">
                        @foreach ($user->tasks as $task)
                            <div class="form-group">
                                <label for="task-{{ $task->id }}">Task {{ $loop->iteration }}</label>
                                <div class="input-group">
                                    <input type="text" value="{{ $task->task }}" name="tasks[{{ $task->id }}]"
                                        id="task-{{ $task->id }}" class="form-control">
                                    <div class="input-group-append">
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
 
                    <button type="submit" class="btn btn-primary mt-3">Update Tasks</button>
                </form>
                <form action="{{ route('tasks.store', $user->id) }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div id="new-tasks"></div>
                    <button type="submit" class="btn btn-primary mt-3">Submit New Tasks</button>
                </form>
                <button type="button" id="add-task" class="btn btn-secondary mt-3">Add Task</button>
            </div>
        </div>
    </div>
 
    <script>
        document.getElementById('add-task').addEventListener('click', function() {
            var container = document.getElementById('new-tasks');
            var index = container.children.length + 1;
            var newTask = document.createElement('div');
            newTask.className = 'form-group';
            newTask.innerHTML = `
                <label for="new-task-${index}">New Task ${index}</label>
                <div class="input-group">
                    <input type="text" name="new_tasks[]" id="new-task-${index}" class="form-control" placeholder="Enter new task">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Remove</button>
                    </div>
                </div>
            `;
            container.appendChild(newTask);
        });
    </script>
@endsection
 