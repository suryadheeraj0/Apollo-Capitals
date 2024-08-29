<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function deleteUser(Request $request,string $id) {
        $user = User::findOrFail($id) ;
        $user->delete() ;
        //activity log
        $user = Auth::user();
        ActivityLog::create([
            'user_id' => $user->id,
             'user_name' => $user->name,
             'role' => $user->role,
             'action' => 'Admin Deleted a User',
             'ip_address' => request()->ip() ,
            'time' => now()
        ]) ;
        return redirect()->back()->with(['message' => 'User Deletd Successfully!']) ;
    }
}
