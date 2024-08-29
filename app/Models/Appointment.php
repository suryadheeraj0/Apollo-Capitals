<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\Customer;
 
class Appointment extends Model
{
    use HasFactory;
 
    protected $fillable=['user_id','customer','appointment_date','details'];
 
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function task(){
        return $this->belongsTo(Task::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
 
