<!-- resources/views/posts/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Search Posts</title>
    <style>
        /* Add your CSS styling here */
        .pagination {
            display: flex;
            list-style-type: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a {
            padding: 8px 12px;
            text-decoration: none;
            color: #007bff;
        }

        .pagination li a:hover {
            background-color: #f1f1f1;
        }

        .form-container {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container input, .form-container select, .form-container button {
            margin: 5px 0;
            padding: 8px;
            font-size: 16px;
        }

        .form-container select {
            width: 150px;
        }
    </style>
</head>
<body>
    <h1>Search Posts</h1>

    <!-- Search Form -->
    <div class="form-container">
        <form action="{{ route('posts.search') }}" method="GET">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
            <label for="date_from">From Date</label>
            <input type="date" id = "date_from" name="date_from" placeholder="From" value="{{ request('date_from') }}">
            <label for="date_to">To Date</label>
            <input type="date" name="date_to" id = "date_to" placeholder="To" value="{{ request('date_to') }}">

    
            <!-- Priority Filter -->
            <label for="priority">Priority</label>
            <select name="priority" id="priority">
                <option value="">Select Priority</option>
                <option value="1" {{ request('priority') == '1' ? 'selected' : '' }}>High</option>
                <option value="2" {{ request('priority') == '2' ? 'selected' : '' }}>Medium</option>
                <option value="3" {{ request('priority') == '3' ? 'selected' : '' }}>Low</option>
            </select>

            <!-- Status Filter -->
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="">Select Status</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Completed</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>In Progress</option>
                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Not Started</option>
            </select>

            <!-- Sorting Options -->
            <select name="sort_by">
                <option value="created_at" {{ $sortBy == 'created_at' ? 'selected' : '' }}>Sort by Date</option>
                <option value="title" {{ $sortBy == 'title' ? 'selected' : '' }}>Sort by Title</option>
                <option value="priority" {{ $sortBy == 'priority' ? 'selected' : '' }}>Sort by Priority</option>
                <option value="status" {{ $sortBy == 'status' ? 'selected' : '' }}>Sort by Status</option>
            </select>

            <select name="sort_direction">
                <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>

            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Search Results -->
    <h2>Search Results</h2>
    <ul>
        @forelse($posts as $post)
            <li>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                <p>Priority: {{ $post->priority }}</p>
                <p>Status: {{ $post->status }}</p>
                
                <h4>Comments:</h4>
                <ul>
                    @foreach($post->comments as $comment)
                        <li>{{ $comment->comment }}</li>
                    @endforeach
                </ul>
            </li>
        @empty
            <p>No results found.</p>
        @endforelse
    </ul>

    <!-- Pagination Links -->
    <div>
        {{ $posts->links() }}
    </div>
</body>
</html>
