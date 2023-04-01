<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpirtUser extends Model
{
    use HasFactory;
    protected $table ="expirts_users";
    protected $fillable=['expirt_id','user_id'];
}
