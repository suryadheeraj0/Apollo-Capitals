<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name',
         'email', 'phone_number', 'lead_status',
          'company', 'address', 'task_id', 
    ] ;
}
