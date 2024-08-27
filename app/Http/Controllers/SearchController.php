<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchPage() {
        $posts = Post::paginate(10) ;
        $sortBy = 'created_at' ;
        $sortDirection = 'asc' ;
        return view('search', compact('posts', 'sortBy', 'sortDirection')) ;
    }
    public function  searchPostsWithComments(Request $request) {
        // Retrieve search query and filter inputs
    $query = $request->input('query');
    $dateFrom = $request->input('date_from');
    $dateTo = $request->input('date_to');
    $priority = $request->input('priority');
    $status = $request->input('status');
    $sortBy = $request->input('sort_by', 'created_at'); // Default sorting by created_at
    $sortDirection = $request->input('sort_direction', 'desc'); // Default sorting direction


    // Start a query builder instance for Post
    $posts = Post::query();

    // Apply search query if present
    if ($query) {
        $posts = $posts->where(function ($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%")
              ->orWhereHas('comments', function ($q) use ($query) {
                  $q->where('comment', 'LIKE', "%{$query}%");
              });
        });
    }

    // Apply date range filter if present
    if ($dateFrom && $dateTo) {
        $posts->whereBetween('created_at', [$dateFrom, $dateTo]);
    } elseif ($dateFrom) {
        $posts->whereDate('created_at', '>=', $dateFrom);
    } elseif ($dateTo) {
        $posts->whereDate('created_at', '<=', $dateTo);
    }


    // Apply priority filter if present
    if ($priority) {
        $posts->where('priority', $priority);
    }

    // Apply status filter if present
    if ($status) {
        $posts->where('status', $status);
    }

    // Apply sorting
    $posts->orderBy($sortBy, $sortDirection);

    // Execute the query with pagination
    $posts = $posts->with('comments')->paginate(10); // Paginate with 10 results per page

    return view('search', compact('posts', 'sortBy', 'sortDirection'));
    }


    public function showUsersList() {
        $users = User::paginate(10) ;
        $sortBy = 'created_at' ;
        $sortDirection = 'asc' ;
        return view('usersListWithAccess', compact('users', 'sortBy', 'sortDirection')) ;
    }

    public function searchUser(Request $request) {
        $query = $request->input('query');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $sortBy = $request->input('sort_by', 'created_at'); // Default sorting by created_at
        $sortDirection = $request->input('sort_direction', 'desc'); // Default sorting direction


        $users = User::query() ;


        if ($query) {
            $users = $users->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('role', 'LIKE', "%{$query}%")
                  ->orWhere('email', ' LIKE', "%{$query}%") ;
            });
        }


        // Apply date range filter if present
        if ($dateFrom && $dateTo) {
            $users->whereBetween('created_at', [$dateFrom, $dateTo]);
        } elseif ($dateFrom) {
            $users->whereDate('created_at', '>=', $dateFrom);
        } elseif ($dateTo) {
            $users->whereDate('created_at', '<=', $dateTo);
        }


         // Apply sorting
        $users->orderBy($sortBy, $sortDirection);
        $users = $users->paginate(10) ;
        
        return view('usersListWithAccess', compact('users', 'sortBy', 'sortDirection'));



    }


}
