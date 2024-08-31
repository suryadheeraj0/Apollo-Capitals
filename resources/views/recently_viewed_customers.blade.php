<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently Viewed Customers</title>
    <!-- Include any CSS files or CDN links here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Recently Viewed Customers</h2>
        
        <!-- Check if there are any recently viewed customers -->
        @if ($recentlyViewedCustomers->isEmpty())
            <div class="alert alert-info">
                No customers have been viewed recently.
            </div>
        @else
            <div class="list-group">
                @foreach ($recentlyViewedCustomers as $customer)
                    <a href="" class="list-group-item list-group-item-action">
                        <h5 class="mb-1">{{ $customer->name }}</h5>
                        <p class="mb-1">Email: {{ $customer->email }}</p>
                        @if (auth()->user()->role === 'Admin')
                        <p>viewed By: {{ $customer->user->name }}</p>
                        @endif
                        <small>Last viewed: {{ $customer->created_at->format('F j, Y, g:i a') }}</small>
                    </a>
                @endforeach
            </div>
        @endif
        <div>
            {{$recentlyViewedCustomers->links()}}
        </div>
        <!-- Back Button -->
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Back</a>
    </div>

    <!-- Include any JavaScript files or CDN links here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
