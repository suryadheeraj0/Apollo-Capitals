@extends('layouts.master')
 
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Roles and Permissions</h2>
            <a href="{{ route('admin.create') }}" class="btn btn-primary">Create Role</a>
        </div>
 
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Roles</th>
                            <th>Assigned Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($role as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if ($role->permissions->isNotEmpty())
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($role->permissions as $permission)
                                                <li>{{ $permission->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span>No permissions assigned</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <a href="{{ route('admin.edit', $role->id) }}"
                                            class="btn btn-outline-secondary">Edit</a>
                                        <form action="{{ route('admin.destroy', $role->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No roles found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>
                <a href="{{route('permissions.create')}}" class="btn-btn-primary-sm">Create Permissions</a>
            </div>
        </div>
        <br>
        <a href="{{route('admin_dashboard')}}" class="btn-btn-danger-sm">Back</a>
    </div>
@endsection