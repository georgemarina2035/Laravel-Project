<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expirt;
class Counseling extends Model
{
    use HasFactory;

     protected $table ="counselings";
     protected $fillable=['counseling'];
     protected $hidden =['created_at','updated_at',];
     public $timestamps=false;

    public function expirts()
    {
        return $this->belongsToMany(Expirt::class,'expirts_counselings','counseling_id','expirt_id');
    }
    
}
