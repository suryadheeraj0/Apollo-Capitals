<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ActivityLogController extends Controller
{
    public function showActivityLogToAdmin() {
        $activityLogs = ActivityLog::paginate(4) ;
        return view('activity_log', compact('activityLogs')) ;
    }


    public function showActivityLogToUser() {

        if (Gate::denies('access-to-show-activity-log')) {
            abort(403, 'Unauthorized action.');
        }

        $userId = auth()->user()->id ;
        $activityLogs = ActivityLog::where('user_id', $userId)->paginate(4) ;
        return view('activity_log', compact('activityLogs')) ;
    }


}
