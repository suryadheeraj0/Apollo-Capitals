<?php
 
namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
 
class AdminRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $role=Role::all();
        return view('admin.index',compact('role'));
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.create');
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'role'=>['required','string','max:255','unique:roles,name'],
            'permissions'=>['required','array'],
        ]);
 
        $role=Role::create(['name'=>$request->role]);
        $role->syncPermissions($request->permissions);
 
        return redirect()->route('admin.index');
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
        //
        $role=Role::findOrFail($id);
        return view('admin.edit',compact('role'));
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $role=Role::findOrFail($id);
        $request->validate([
            'permissions'=>['required','array'],
        ]);
 
 
        $role->syncPermissions($request->permissions);
 
        return redirect()->route('admin.index');
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $role=Role::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.index');
    }
}