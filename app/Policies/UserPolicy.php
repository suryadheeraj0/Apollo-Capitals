<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */

    public function viewTasksForAdmin(User $user) {
        return $user->hasPermissionTo('view tasks for admin') ;
        //return false;
    }

    public function adminPageAccess(User $user) {
        return $user->hasPermissionTo('admin page access') ;
    }

    public function adminAppointmentsPageAccess(User $user) {
        return $user->hasPermissionTo('admin appointments page access') ;
    }
    
}
