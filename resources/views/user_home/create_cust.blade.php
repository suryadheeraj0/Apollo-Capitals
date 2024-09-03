@extends('layouts.master')
 
@section('content')
    <div class="container mt-5">


        <h1>Search Customers</h1>

    <!-- Search Form -->
    <div class="form-container">
        <form action="{{ route('usersCustomers.results') }}" method="GET">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
            <label for="date_from">From Date</label>
            <input type="date" id = "date_from" name="date_from" placeholder="From" value="{{ request('date_from') }}">
            <label for="date_to">To Date</label>
            <input type="date" name="date_to" id = "date_to" placeholder="To" value="{{ request('date_to') }}">

            <!-- Sorting Options -->
            <select name="sort_by">
                <option value="created_at" {{ $sortBy == 'created_at' ? 'selected' : '' }}>Sort by Date</option>
                <option value="name" {{ $sortBy == 'title' ? 'selected' : '' }}>Sort by name</option>
                <option value="email" {{ $sortBy == 'priority' ? 'selected' : '' }}>Sort by email</option>
                <option value="phone_number" {{ $sortBy == 'status' ? 'selected' : '' }}>Sort by Phone Number</option>
            </select>

            <select name="sort_direction">
                <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>

            <button type="submit">Search</button>
        </form>
    </div>






        <div class="text-center">
            <h1 class="display-4">View Customers</h1>
            <p class="lead">
        </div>
 
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>New Customer Information</h3>
                    </div>
                    <div class="card-body">
                        @if ($customers->isEmpty())
                            <p>No customers have been assigned to you yet. Start adding a new
                                customer to your system and begin managing their appointments and details seamlessly.</p>
                        @else
                            <h5>Assigned Customers:</h5>
                            <table class="table table-bordered table-hover mt-3">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone_number }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href='{{ route('edit_customer', $customer->id) }}'
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                        <br>
                                                        <a href='{{ route('view-customer', $customer->id) }}'
                                                            class="btn btn-success btn-sm">View Customer</a>
                                                    <form action='{{ route('delete_customer', $customer->id) }}'
                                                        method='POST'>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        <div class="mt-3">
                            <a href="{{ route('back') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 
