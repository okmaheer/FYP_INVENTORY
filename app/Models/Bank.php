<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name',
        'account_name',
        'account_number',
        'branch',
        'signature_pic',
        'location_id'
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
                    return array('view_bank');
                    break;
                case 'create':
                case 'store':
                    return array('create_bank');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_bank');
                    break;
                case 'delete':
                    return array('delete_bank');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_bank',
            'create_bank',
            'edit_bank',
            'delete_bank',
            'bank_transactions',
            'bank_ledger',
        );
    }

}
