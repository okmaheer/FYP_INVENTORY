<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable =
    [

        'person_name',
        'person_phone',
        'person_address',

    ];
    protected $table = "persons";

    /*public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'manage':
                case 'show':
                    return array('view_person');
                    break;
                case 'create':
                case 'store':
                    return array('create_person');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_person');
                    break;
                case 'delete':
                    return array('delete_person');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_person',
            'create_person',
            'edit_person',
            'delete_person',
        );
    }*/


}
