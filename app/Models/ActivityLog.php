<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable  = [
        'id',
        'user_id',
        'user_name',
        'action',
        'time',
        'role',
        'ip_address'
    ] ;
}
