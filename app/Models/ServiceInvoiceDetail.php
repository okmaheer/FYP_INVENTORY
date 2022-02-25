<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'qty',
        'charge',
        'discount',
        'discount_amount',
        'total'

    ];


}
