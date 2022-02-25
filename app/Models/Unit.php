<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_name',
        'status',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function products(){
        return $this->hasMany(Product::class,'unit','id');
    }
     public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_unit');
                    break;
                case 'create':
                case 'store':
                    return array('create_unit');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_unit');
                    break;
                case 'delete':
                    return array('delete_unit');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_unit',
            'create_unit',
            'edit_unit',
            'delete_unit',
        );
    }

}
