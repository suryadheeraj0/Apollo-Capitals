@extends('layouts.master')
 
@section('content')
    <div class="container mt-4">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
 
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="mb-0">Create Role</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.store') }}" method="POST">
                    @csrf
 
                    <div class="mb-3">
                        <label for="role" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="role" name="role"
                            placeholder="Enter role name" required>
                    </div>
 
                    <div class="mb-3">
                        <label for="permissions" class="form-label">Assign Permissions</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="create_role" name="permissions[]"
                                        value="create_role">
                                    <label class="form-check-label" for="create_role">Create Role</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="edit_role" name="permissions[]"
                                        value="edit_role">
                                    <label class="form-check-label" for="edit_role">Edit Role</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="delete_role" name="permissions[]"
                                        value="delete_role">
                                    <label class="form-check-label" for="delete_role">Delete Role</label>
                                </div>
                            </div>
                        </div>
                    </div>
 
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
 