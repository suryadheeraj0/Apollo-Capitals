<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Lead</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<!-- Success Message -->
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

        <h2 class="mb-4">Create New Lead</h2>
        
        <!-- Lead Creation Form -->
        <form action="{{route('store-lead')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter lead name" >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter lead email" >
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter lead address" >
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter phone number" >
            </div>

            <div class="mb-3">
                <label for="lead_status" class="form-label">Lead Status</label>
                <select class="form-select" id="lead_status" name="lead_status">
                    <option value="1" selected>Not Contacted</option>
                    <option value="2">Contacted</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Lead</button>
            <br>
        </form>

        <a href="{{route('home')}}"><button type="submit" class="btn btn-danger">back</button></a>
    </div>

    <!-- Bootstrap JS (Optional if you use Bootstrap JavaScript plugins) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
