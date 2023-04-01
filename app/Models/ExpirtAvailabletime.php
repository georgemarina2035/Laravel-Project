<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpirtAvailabletime extends Model
{
    use HasFactory;
    protected $table ="expirts_availabletimes";
    protected $fillable=['expirt_id','availabletime_id'];

public function expirts(){
    return $this->belongsTo(Expirt::class);
}
}
