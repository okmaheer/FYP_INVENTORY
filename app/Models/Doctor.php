<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'mobile',
        'email',
        'address',
        'icon',
        'profile_picture',
        'o_time',
        'c_time',
        'clinic_pic',
        'year_exp',
        'whatsapp',
        'ig_username',
        'location_id',
        'specialist_id'
    ];
    public function specialist(){
        return $this->belongsTo(Specialist::class,'specialist_id','id');
    }
    public function location(){
        return $this->belongsTo(Location::class,'location_id','id');
    }


}
