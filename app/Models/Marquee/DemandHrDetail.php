<?php

namespace App\Models\Marquee;

use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandHrDetail extends Model
{
    protected $table= 'demand_hr_details';
    use HasFactory;

    public function designation(){
        return $this->belongsTo(Designation::class,'designation_id','id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
