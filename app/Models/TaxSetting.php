<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxSetting extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'default_value',
        'ax_name',
        'nt',
        'reg_no',
        'is_show',
    ];
    
}
