<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name',
        'detail',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class,'designation_id','id');
    }
    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_hrm_designation');
                    break;
                case 'create':
                case 'store':
                    return array('create_hrm_designation');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_hrm_designation');
                    break;
                case 'delete':
                    return array('delete_hrm_designation');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_hrm_designation',
            'create_hrm_designation',
            'edit_hrm_designation',
            'delete_hrm_designation',
        );
    }


}
