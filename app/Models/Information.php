<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table='informations';
    protected $fillable = [
        'name',
        'image',
        'experience',
        'mobile',
        'email',
        'address',
        'expirt_id'
    ];
    protected $hidden=['created_at','updated_at'];


    public function expirts()
    {
        return $this->belongsTo(Expirt::class);
    }
}
