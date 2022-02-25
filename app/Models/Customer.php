<?php

namespace App\Models;

use App\Models\Marquee\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'customer_name',
        'customer_mobile',
        'customer_email',
        'cnic',
        'phone',
        'contact',
        'customer_address',
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

    public function invoice(){
        return $this->hasMany(Invoice::class,'customer_id','id');
    }

    public function transactions(){
        return $this->hasMany(Transaction::class,'VNo','id');
    }

    public function quotations(){
        return $this->hasMany(Quotation::class,'customer_id','id');
    }

    public function accountHead(){
        return $this->hasOne(AccountHead::class);
    }

    public function headName()
    {
        return $this->id.'-'.$this->customer_name;
    }

    public function getCustomerName($id){
        return $this->where('id',$id)->value('customer_name');
    }

    public function bookings(){
        return $this->hasMany(Booking::class,'customer_option','id');
    }

    public function stages(){
        return $this->hasMany(Stage::class,'customer_id','id');
    }

    public function getNameCnicAttribute() {
        return $this->customer_name . ' [' . $this->cnic . ']';
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_customer');
                    break;
                case 'create':
                case 'store':
                    return array('create_customer');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_customer');
                    break;
                case 'delete':
                    return array('delete_customer');
                    break;
                case 'ledger':
                    return array('customer_ledger');
                    break;
                case 'advance':
                    return array('customer_advance');
                    break;
                case 'creditCustomer':
                    return array('credit_customer_list');
                    break;
                case 'paidCustomer':
                    return array('paid_customer_list');
                    break;

                default:
                    return array();
            }

        }

        return array(
            'view_customer',
            'create_customer',
            'edit_customer',
            'delete_customer',
            'customer_ledger',
            'customer_advance',
            'credit_customer_list',
            'paid_customer_list',
        );
    }

}
