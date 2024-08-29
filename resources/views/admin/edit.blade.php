@extends('layouts.master')
 
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Edit Role Permissions</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
 
                    <div class="mb-4">
                        <label for="roleName" class="form-label">Role</label>
                        <input type="text" id="roleName" class="form-control" value="{{ $role->name }}" readonly>
                    </div>
 
                    <div class="mb-4">
                        <label for="permissions" class="form-label">Edit Permissions</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="{{ $permission->id }}"
                                            name="permissions[]" value="{{ $permission->name }}"
                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $permission->id }}">
                                            {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
 
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection