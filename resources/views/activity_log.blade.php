<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Activity Log</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 12px;
            background-color: #f8f9fa;
            margin-bottom: 20px;
        }
        .card-title {
            color: #007bff;
        }
        .card-footer {
            background-color: transparent;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Activity Log</h2>
        <div class="row">
            @foreach ($activityLogs as $log)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title mb-2">User: {{ $log->user_name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Role: {{ $log->role }}</h6>
                            <p class="card-text">
                                <strong>Action:</strong> {{ $log->action }}<br>
                                <strong>Time:</strong> {{ $log->time }}<br>
                                <strong>IP Address:</strong> {{ $log->ip_address }}<br>
                            </p>
                        </div>
                        <div class="card-footer text-end">
                            <small class="text-muted">Last Updated: {{ $log->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            {{$activityLogs->links()}}
        </div>
        <div>
            <a href="{{route('home')}}" class="btn-btn-danger">Back</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
