<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalLoan extends Model
{
    use HasFactory;

    /*public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'manage':
                case 'show':
                    return array('view_person_1');
                    break;
                case 'create':
                case 'store':
                    return array('create_person_1');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_person_1');
                    break;
                case 'delete':
                    return array('delete_person_1');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_person_1',
            'create_person_1',
            'edit_person_1',
            'delete_person_1',
        );
    }*/


}
