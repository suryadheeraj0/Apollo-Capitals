<?php
namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Show the form for creating a new permission.
     *
     * @return \Illuminate\View\View
     */

    //returns a form to create a new permission
    public function create()
    {
        return view('permissions_create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

     //validates the permission and stores in permissions model
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        //activity log
        $user = Auth::user();
        ActivityLog::create([
            'user_id' => $user->id,
             'user_name' => $user->name,
             'role' => $user->role,
             'action' => 'user created a new permissions!',
             'ip_address' => request()->ip() ,
            'time' => now()
        ]) ;

        return redirect()->route('permissions.create')->with('success', 'Permission created successfully.');
    }
}
