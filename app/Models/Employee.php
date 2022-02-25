<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'first_name',
        'last_name',
        'designation_id',
        'phone',
        'rate_type',
        'hrate',
        'email',
        'blood_group',
        'address_line_1',
        'loan_percentage',
        'image',
        'document',
        'country',
        'city',
        'zip',
        'working_hour',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class,'designation_id','id');
    }

    public function accountHead(){
        return $this->hasOne(AccountHead::class);
    }

    public function headName()
    {
        return $this->id.'-'.$this->first_name.' '.$this->last_name;
    }
    public function getEmployeeName($id){
        return $this->find($id)->value('first_name');
    }
    public function salary(){
        return $this->belongsTo(Salary::class,'id','employee_id');
    }
    public function attendance(){
        return $this->hasMany(Attendance::class);
    }
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_employee');
                    break;
                case 'create':
                case 'store':
                    return array('create_employee');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_employee');
                    break;
                case 'delete':
                    return array('delete_employee');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_employee',
            'create_employee',
            'edit_employee',
            'delete_employee',
            'sync_employees_with_machine',
        );
    }


}
