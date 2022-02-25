<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    use HasFactory;
    protected $fillable =
    [

        'service_name',
        'charge',
        'description',

    ];
    protected $table = "product_services";

    /*public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'manage':
                case 'show':
                    return array('view_service');
                    break;
                case 'create':
                case 'store':
                    return array('create_service');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_service');
                    break;
                case 'delete':
                    return array('delete_service');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_service',
            'create_service',
            'edit_service',
            'delete_service',
        );
    }*/
}
