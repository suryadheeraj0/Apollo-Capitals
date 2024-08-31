<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lead</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Lead</h2>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Lead Form -->
    <form action="{{ route('leads.update', $lead->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$lead->name}}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $lead->email }}" >
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $lead->phone_number }}" >
        </div>

        <div class="form-group">
            <label for="phone_number">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $lead->address }}" >
        </div>

        <div class="form-group">
            <label for="lead_status">Lead Status</label>
            <select name="lead_status" id="lead_status" class="form-control" >
                <option value="1" {{ old('lead_status', $lead->lead_status) == '1' ? 'selected' : '' }}>Not Contacted</option>
                <option value="2" {{ old('lead_status', $lead->lead_status) == '2' ? 'selected' : '' }}>Contacted</option>
                <option value="3" {{ old('lead_status', $lead->lead_status) == '3' ? 'selected' : '' }}>Convert to Customer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Lead</button>
        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
