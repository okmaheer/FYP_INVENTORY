<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'employee_id',
        'clock_in',
        'clock_out',
        'created_by',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_attendance');
                    break;
                case 'create':
                case 'store':
                    return array('create_attendance');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_attendance');
                    break;
                case 'delete':
                    return array('delete_attendance');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_attendance',
            'create_attendance',
            'edit_attendance',
            'delete_attendance',
            'sync_attendance_from_machine',
            'attendance_report',
        );
    }

}
