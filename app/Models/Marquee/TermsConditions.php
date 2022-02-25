<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsConditions extends Model
{
    use HasFactory;
    protected $table = 'terms_conditions';

    protected $fillable = [
        'is_urdu',
        'event_terms',
        'stage_terms',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(BusinessLocation::class);
    }
}
