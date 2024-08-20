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

    <div class="container mt-4 mt-3">
        @if ($errors->any())
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">Validation Errors</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>

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
            <input type="password" class="form-control" id="newPassword" name="password" >
        </div>

        <!-- Confirm New Password Input -->
        <div class="mb-3">
            <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmNewPassword" name="password_confirmation">
        </div>

        <div class="alert alert-info mt-4">
            <strong>Password Requirements:</strong>
            <ul class="mb-0">
                <li>At least 8 characters long</li>
                <li>One uppercase letter</li>
                <li>One lowercase letter</li>
                <li>One number</li>
                <li>One special character (e.g., !@#$%^&*)</li>
            </ul>
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
