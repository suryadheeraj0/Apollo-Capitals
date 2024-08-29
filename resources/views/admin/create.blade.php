@extends('layouts.master')
 
@section('content')
    <div class="container mt-4">
        <h2>Create Role</h2>
 
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
 
            <div class="mb-4">
                <label for="roleName" class="form-label">Role Name</label>
                <input type="text" id="roleName" name="role" class="form-control" placeholder="Enter Role" required>
            </div>
 
            <div class="mb-4">
                <label for="permissions" class="form-label">Permissions</label>
                <div class="row">
                    @foreach ($permissions as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="{{ $permission->id }}"
                                    name="permissions[]" value="{{ $permission->name }}">
                                <label class="form-check-label" for="{{ $permission->id }}">
                                    {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
 
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
 