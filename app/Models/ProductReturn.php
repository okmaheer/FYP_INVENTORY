<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'date_purchase',
        'date_return',
        'byy_qty',
        'ret_qty',
        'product_rate',
        'deduction',
        'total_deduct',
        'total_tax',
        'total_ret_amount',
        'net_total_amount',
        'reason',
        'usablity'

    ];

}
