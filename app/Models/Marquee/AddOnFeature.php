<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOnFeature extends Model
{
    use HasFactory;

    protected $table = 'add_on_features';
    protected $fillable = [
        'barcode',
        'name',
        'price',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(BusinessLocation::class);
    }
}
