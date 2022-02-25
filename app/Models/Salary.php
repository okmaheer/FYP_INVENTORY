<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = "salaries";
    protected $dates = ['paid_at'];

    protected $fillable = [
        'salary_no',
        'employee_id',
        'salary_month',
        'total_salary',
        'paid_salary',
        'attendance',
        'present',
        'deduction',
        'deduction_type',
        'deduction_reason',
        'generated_by',
        'type',
        'status',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class,'VNo','salary_no');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id', 'id');
    }

    public function generatedBy(){
        return $this->belongsTo(User::class,'generated_by','id');
    }

    public function paidBy(){
        return $this->belongsTo(User::class,'paid_by','id');
    }

    public function receivedBy(){
        return $this->belongsTo(Employee::class,'received_by','id');
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {
        return array(
            'view_salary',
            'create_salary',
            'delete_salary',
            'salary_payment',
            'salary_payslip',
            'advance_salary',
        );
    }
}
