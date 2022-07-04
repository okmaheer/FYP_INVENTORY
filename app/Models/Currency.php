<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'currency_name',
        'icon',


    ];

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'manage':
                case 'show':
                    return array('view_currency');
                    break;
                case 'create':
                case 'store':
                    return array('create_currency');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_currency');
                    break;
                case 'delete':
                    return array('delete_currency');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_currency',
            'create_currency',
            'edit_currency',
            'delete_currency',
        );
    }


}
