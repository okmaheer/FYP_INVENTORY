<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareSetting extends Model
{
    use HasFactory;
    protected $table = 'hardware_setting';

    protected $fillable = [
        'attendance_ip',
        'attendance_port',
        'printer_ip',
        'printer_port',
        'printer_type',
        'printer_path',
        'printer_char_per_line',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function UpdatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
}
