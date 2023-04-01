<?php

namespace App\Models;

use App\Models\User;
use App\Models\AvailableTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Date extends Model
{
    use HasFactory;
    protected $table ="dates";
    protected $fillable=['day','from','to','availabletime_id'];
    protected $hidden =['created_at','updated_at',];
    public $timestamps=false;


public function availabletimes()
{
    return $this->belongsTo(AvailableTime::class);
}
public function users()
{
    return $this->belongsToMany(User::class);
}
}
