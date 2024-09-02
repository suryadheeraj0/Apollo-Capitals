<?php
 
namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
 
class AdminRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //showing all existing roles
        $role=Role::all();
        info($role) ;
        return view('admin.index',compact('role'));
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //form for creating a new role
        $user=auth()->user();
        $permissions = Permission::all() ;
        return view('admin.create',compact('user', 'permissions'));
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'role' => ['required', 'string', 'max:255', 'unique:roles,name'],
        'permissions' => ['required'],
       ]);
 
       $role = Role::create(['name' => $request->role]);
       $role->syncPermissions($request->permissions);

       //activity log
       $user = Auth::user();
       ActivityLog::create([
           'user_id' => $user->id,
            'user_name' => $user->name,
            'role' => $user->role,
            'action' => 'user Created a new role!',
            'ip_address' => request()->ip() ,
           'time' => now()
       ]) ;
 
       return redirect()->route('admin.index')->with(['success' => 'New Role is Created!']);
    }
 
 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //edit form to edit permissions
        $role=Role::findOrFail($id);
        $permissions = Permission::all() ;
        return view('admin.edit',compact('role', 'permissions'));
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //updating the permissions
        $role=Role::findOrFail($id);

        $role->syncPermissions($request->permissions);

        //activity log
        $user = Auth::user();
        ActivityLog::create([
            'user_id' => $user->id,
             'user_name' => $user->name,
             'role' => $user->role,
             'action' => 'user updated roles and permissions!',
             'ip_address' => request()->ip() ,
            'time' => now()
        ]) ;
 
        return redirect()->route('admin.index')->with(['success' => 'Permissions are Updated!']);
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //deleting the role
        $role=Role::findOrFail($id);
        $role->delete();



        //activity log
        $user = Auth::user();
        ActivityLog::create([
            'user_id' => $user->id,
             'user_name' => $user->name,
             'role' => $user->role,
             'action' => 'user deleted a role!',
             'ip_address' => request()->ip() ,
            'time' => now()
        ]) ;


        return redirect()->route('admin.index')->with(['success' => 'Role Deleted!']);
    }
}
 