<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyClosing extends Model
{
    use HasFactory;

    protected $fillable =
    [

        'last_day_closing',
        'cash_in',
        'cash_out',
        'date',
        'amount',
        'adjustment',
        'status',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }
}
