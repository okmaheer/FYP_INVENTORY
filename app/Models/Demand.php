<?php

namespace App\Models;

use App\Models\Marquee\Booking;
use App\Models\Marquee\DemandHrDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = [
        'custom_booking_number',
        'belongs',
        'demand_type',
        'generated_by',
        'narration'
    ];

    use HasFactory;

    public function demandDetails(){

        return $this->hasMany(DemandDetail::class,'demand_id','id');
    }

    public function demandHrDetails(){

        return $this->hasMany(DemandHrDetail::class,'demand_id','id');
    }

    public function booking(){
        return $this->belongsTo(Booking::class,'custom_booking_number','custom_booking_number');
    }
    public function maxId(){
        $data = $this->selectRaw('COALESCE(MAX(id),0)+1 as id')->first();
        $data = ($data->id > 0) ? $data->id : 1;
        return $data;
    }
}
