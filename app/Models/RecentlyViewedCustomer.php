<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentlyViewedCustomer extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id', 'name', 'email', 'phone_number', 'company',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
