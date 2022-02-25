<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotProductsUsed extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'serial_no',
        'description',
        'used_qty',
        'supplier_rate',
        'total_price',
        'discount',
        'discount_per',
        'tax',

    ];

    
}
