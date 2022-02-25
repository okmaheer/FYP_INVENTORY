<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInvoice extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'voucher_no',
        'date',
        'total_amount',
        'total_discount',
        'invoice_discount',
        'total_tax',
        'paid_amount',
        'due_amount',
        'shipping_cost',
        'previous',
        'details'

    ];

    /*public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'manage':
                case 'show':
                    return array('view_service_invoice');
                    break;
                case 'create':
                case 'store':
                    return array('create_service_invoice');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_service_invoice');
                    break;
                case 'delete':
                    return array('delete_service_invoice');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_service_invoice',
            'create_service_invoice',
            'edit_service_invoice',
            'delete_service_invoice',
        );
    }*/


}
