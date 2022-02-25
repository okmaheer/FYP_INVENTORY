<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLoan extends Model
{
    use HasFactory;
    protected $table = 'employee_loan';
    protected $dates = ['date', 'return_date'];

    protected $fillable = [
        'loan_no',
        'employee_id',
        'date',
        'loan_amount',
        'return_type',
        'return_date',
        'deduct_type',
        'deduct_value',
        'deduct_amount',
        'details',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class,'VNo','loan_no');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function requestedBy(){
        return $this->belongsTo(User::class,'requested_by','id');
    }

    public function approvedBy(){
        return $this->belongsTo(User::class,'approved_by','id');
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        return array(
            'create_loan_request',
            'approve_loan_request',
            'receive_loan',
            'view_loans',
            'loan_report',
            'loan_payment',
        );
    }
}
