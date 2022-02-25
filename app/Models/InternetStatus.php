<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternetStatus extends Model
{
    use HasFactory;

    protected $table = 'internet_status';
    protected $fillable = [
        'name', 'is_synced'
    ];
}
