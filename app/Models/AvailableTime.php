<?php

namespace App\Models;

use App\Models\Date;
use App\Models\Expirt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AvailableTime extends Model
{
    use HasFactory;
    protected $table ="availabletimes";
    protected $fillable=['day','from','to','available'];
    protected $hidden =['created_at','updated_at','pivot'];
    public $timestamps=false;

public function expirts()
{
    return $this->belongsToMany(Expirt::class,'expirts_availabletimes','availabletime_id','expirt_id');
}
public function dates()
{
    return $this->hasOne(Date::class);
}
}