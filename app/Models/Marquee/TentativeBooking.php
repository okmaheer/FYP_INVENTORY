<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentativeBooking extends Model
{
    use HasFactory;
    protected $dates = ['event_date', 'delivery_date'];

    protected $fillable = [
        'tentative_number',
        'customer_name',
        'phone_number',
        'customer_address',
        'event_area',
        'event_date',
        'no_person',
        'event_time',
        'start_time',
        'end_time',
        'rate_per_head',
        'partition',
        'venue',
        'booking_detail',
        'event_type',

        'delivery_date',
        'delivery_time',
        'delivery_address',
        'delivery_charges',

        'location_id',
    ];

    protected $casts = [
        'venue' => 'array',
    ];

    public function location()
    {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function eventAreaName($id) {
        return EventArea::find($id)->name;
    }

    public function eventAreaColor($id) {
        return EventArea::find($id)->bgColor;
    }

}
