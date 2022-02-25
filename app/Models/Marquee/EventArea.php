<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventArea extends Model
{
    use HasFactory;

    protected $table = 'event_areas';
    protected $fillable = [
        'name',
        'bgColor',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(BusinessLocation::class);
    }
}
