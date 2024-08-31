<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">All Leads</h2>

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        @forelse($leads as $lead)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $lead->name }}</h5>
                        <p class="card-text"><strong>Email:</strong> {{ $lead->email }}</p>
                        <p class="card-text"><strong>Phone Number:</strong> {{ $lead->phone_number }}</p>
                        <p class="card-text"><strong>Address:</strong> {{ $lead->address }}</p>
                        <p class="card-text"><strong>Lead Status:</strong>
                            @if ($lead->lead_status == 1)
                                {{ 'Not Contacted' }}
                            @elseif ($lead->lead_status == 2)
                                {{ 'Contacted' }}
                            @else
                                {{ 'Convert to Customer' }}
                            @endif
                        </p>
                        <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-primary">Update</a>
                        
                        <!-- Delete button form -->
                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this lead?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No leads found.</div>
            </div>
        @endforelse
    </div>
    <div>
        <a href="{{route('home')}}"><button class="btn btn-danger">Back</button></a>
    </div>
    <div>
        {{$leads->links()}}
    </div>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
