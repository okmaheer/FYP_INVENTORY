<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySetup extends Model
{
    use HasFactory;
    protected $fillable =
    [

        'e_s_s_id',
        'sal_type',
        'amount',
        'create_date',
        'update_date',
        'update_id',
        'gross_salary'


    ];

    /*public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'manage':
                case 'show':
                    return array('view_salary_setups');
                    break;
                case 'create':
                case 'store':
                    return array('create_salary_setups');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_salary_setups');
                    break;
                case 'delete':
                    return array('delete_salary_setups');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_salary_setups',
            'create_salary_setups',
            'edit_salary_setups',
            'delete_salary_setups',
        );
    }*/


}
