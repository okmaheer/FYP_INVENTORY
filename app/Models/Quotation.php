<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable =
    [

        'customer_id',
        'address',
        'qdate',
        'mobile',
        'expiry_date',
        'details',
        'product_name',
        'desc',
        'available_quantity',
        'product_quantity',
        'product_rate',
        'discount',
        'total_price',

    ];

    public function products(){
        return  $this->hasMany(Product::class,'product_id','id');
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class,'quotation_no','id');
    }

    public  function purchaseDetails(){
        return $this->hasMany(PurchaseDetails::class,'purchase_id','id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'manage':
                case 'show':
                    return array('view_quotation');
                    break;
                case 'create':
                case 'store':
                    return array('create_quotation');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_quotation');
                    break;
                case 'delete':
                    return array('delete_quotation');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_quotation',
            'create_quotation',
            'edit_quotation',
            'delete_quotation',
        );
    }

}
