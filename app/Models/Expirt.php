<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Counseling;
class Expirt extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "expirts";
    protected $fillable = [
        'name','email','password',    
    ];
    protected $hidden=['created_at','updated_at','email','password'];
    public $timestamps=false;
   
    public function informations()
    {
        return $this->hasOne(Information::class);
    }

    public function counselings()
    {
        return $this->belongsToMany(Counseling::class,'expirts_counselings','expirt_id','counseling_id');
    }
    public function availabletimes()
    {
        return $this->belongsToMany(AvailableTime::class,'expirts_availabletimes','expirt_id','availabletime_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


}
