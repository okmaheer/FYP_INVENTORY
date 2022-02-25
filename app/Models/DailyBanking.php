<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyBanking extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'date',
        'deposit_type',
        'transaction_type',
        'description',
        'amount',
        'status'


    ];

    
}
