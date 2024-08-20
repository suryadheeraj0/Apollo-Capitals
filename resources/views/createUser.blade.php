<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Create New User</h1>

    <!-- User Information Section -->
    <form action="{{route('storeUser')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="firstName" class="form-label">Name</label>
            <input type="text" class="form-control" id="firstName" name="name" required>
        </div>


        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <!-- Role Assignment Section -->
        <div class="mb-4">
            <label for="roles" class="form-label">Assign Role</label>
            <select class="form-select" id="roles" name="role">
                <option value="">Select</option>
                <option value="AccountManager">Account Manager</option>
                <option value="user">User</option>
            </select>
        </div>
        
        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Save & Create</button>
            <a href="" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
