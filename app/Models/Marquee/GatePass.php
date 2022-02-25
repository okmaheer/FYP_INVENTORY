<?php

namespace App\Models\Marquee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatePass extends Model
{
    use HasFactory;

    protected $table = 'gate_passes';

    protected $fillable = [
        'booking_id',
        'customer_name',
        'event_area',
        'event_date',
        'issue_by',
        'issue_date',
        'gatepass_no',
        'phone_number',
        'national_id_card',
        'event_time',
        'address',
        'receive_date'
    ];
}
