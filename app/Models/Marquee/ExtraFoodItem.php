<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraFoodItem extends Model
{
    use HasFactory;

    protected $table = 'extra_food_items';
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
