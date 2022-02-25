<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected  $table = 'taxes';

    protected $fillable = [
        'tax_name',
        'tax_type',
        'tax_value',
        'status',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_tax');
                    break;
                case 'create':
                case 'store':
                    return array('create_tax');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_tax');
                    break;
                case 'delete':
                    return array('delete_tax');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_tax',
            'create_tax',
            'edit_tax',
            'delete_tax',
        );
    }

}
