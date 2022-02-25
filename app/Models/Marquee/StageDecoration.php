<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageDecoration extends Model
{
    use HasFactory;

    protected $table = 'stage_decorations';
    protected $fillable = [
        'barcode',
        'name',
        'price',
        'location_id'
    ];

    public function location()
    {
        return $this->belongsTo(BusinessLocation::class);
    }
}
