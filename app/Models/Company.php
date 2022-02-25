<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'company_name',
        'email',
        'address',
        'mobile',
        'website',
        'status',
        'phone',
        'gstn',
        'logo'

    ];

    /*public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_company');
                    break;
                case 'create':
                case 'store':
                    return array('create_company');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_company');
                    break;
                case 'delete':
                    return array('delete_company');
                    break;

                default:
                    return array();
            }

        }

        return array(
            'view_company',
            'create_company',
            'edit_company',
            'delete_company',
        );
    }*/

}
