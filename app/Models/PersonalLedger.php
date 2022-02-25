<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalLedger extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'date',
        'debit',
        'credit',
        'details',
        'status'
    ];


}
