<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FiscalYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['period_start_date', 'period_end_date'];
    protected $fillable = [
        'name',
        'location_id',
        'status',
        'period_start_date',
        'period_end_date',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }
}
