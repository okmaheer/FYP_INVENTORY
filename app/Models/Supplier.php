<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = "suppliers";

    protected $fillable = [
        'supplier_name',
        'supplier_mobile',
        'supplier_email',
        'cnic',
        'phone',
        'contact',
        'supplier_address',
        'address2',
        'fax',
        'city',
        'state',
        'zip',
        'country',
        'previous_balance',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'supplier_products');
    }
    public function purchases(){

        return $this->hasMany(Purchase::class,'supplier_id','id');
    }

    public function accountHead(){
        return $this->hasOne(AccountHead::class);
    }

    public function headName()
    {
        return $this->id.'-'.$this->supplier_name;
    }
    public function getSupplierName($id){
        return $this->find($id)->supplier_name;
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_supplier');
                    break;
                case 'create':
                case 'store':
                    return array('create_supplier');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_supplier');
                    break;
                case 'delete':
                    return array('delete_supplier');
                    break;
                case 'ledger':
                    return array('supplier_ledger');
                    break;
                case 'advance':
                    return array('supplier_advance');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_supplier',
            'create_supplier',
            'edit_supplier',
            'delete_supplier',
            'supplier_ledger',
            'supplier_advance',
        );
    }


}
