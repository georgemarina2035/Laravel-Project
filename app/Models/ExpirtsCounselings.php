<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpirtsCounselings extends Model
{
    use HasFactory;
    protected $table ="expirts_counselings";
    protected $fillable=['expirt_id','counseling_id'];
     public $timestamps=true;
}
