<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollTaxSetup extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'tax_setup_id',
        'start_amount',
        'rate',
        'status'
    ];

    
}
