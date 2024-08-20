<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Set Up Your Password</h1>

    <!-- Password Setup Form -->
    <form action="{{route('storeActivatedUser')}}" method="POST">
        @csrf

        <!-- Dummy Password Display -->
        <div class="mb-3">
            <label for="dummyPassword" class="form-label">Dummy Password</label>
            <input type="text" class="form-control" id="dummyPassword" name="dummyPassword">
            <small class="form-text text-muted">This is your temporary password. You should change it immediately.</small>
        </div>

        <!-- New Password Input -->
        <div class="mb-3">
            <label for="newPassword" class="form-label">New Password</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
        </div>

        <!-- Confirm New Password Input -->
        <div class="mb-3">
            <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Save Password</button>
            <a href="" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
