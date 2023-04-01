<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDates extends Model
{
    use HasFactory;
    protected $table = "users_dates";
    protected $fillable = [
        'user_id','available_id',    
    ];
    
}
