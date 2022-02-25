<?php

namespace App\Models\Marquee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatPlanning extends Model
{
    use HasFactory;

    protected $table = 'seat_plannings';
    protected $fillable = [
        'barcode', 'name', 'price'
    ];
}
