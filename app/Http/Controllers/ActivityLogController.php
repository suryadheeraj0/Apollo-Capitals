<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ActivityLogController extends Controller
{
    //returns activity log view for admin
    public function showActivityLogToAdmin() {
        $activityLogs = ActivityLog::paginate(4) ;
        return view('activity_log', compact('activityLogs')) ;
    }


    //returns activity log to user
    public function showActivityLogToUser() {

        /*which checks permission by permissions model and gates are
        used which is defiend in authserviceprovider */
        if (Gate::denies('access-to-show-activity-log')) {
            abort(403, 'Unauthorized action.');
        }
        //only user specific
        $userId = auth()->user()->id ;
        $activityLogs = ActivityLog::where('user_id', $userId)->paginate(4) ;
        return view('activity_log', compact('activityLogs')) ;
    }


}
