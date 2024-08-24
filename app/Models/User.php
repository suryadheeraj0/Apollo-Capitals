<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; 
use Laravel\Fortify\TwoFactorAuthenticatable;




class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_activated'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    *we created a static method which can't be accessed by th instances
    and we used updating event listener of the model and overriden the parent boot method
    *
    */
    public static function boot() {
        //overriden the parent boot method
        parent::boot() ;

        static::updating(function($user){
            //isDirty used to check the password has been changed or not?
            if ($user->isDirty('password')) {
                $user->password_changed_at = Carbon::now() ;
            }
        }) ;
    }
}
