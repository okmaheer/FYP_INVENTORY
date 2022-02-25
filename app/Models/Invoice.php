<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $dates = ['date'];

    protected $fillable = [
        'date',
        'invoice_no',
        'customer_id',
        'net_total',
        'grand_total_price',
        'paid_amount',
        'due_amount',
        'previous_due',
        'shipping_cost',
        'invoice_discount',
        'total_discount',
        'tax_id',
        'total_tax',
        'status',
        'invoice_details',
        'payment_type',
        'is_online',
        'location_id',
        'payment_account',
    ];

    public function paymentAccount() {
        return $this->belongsTo(AccountHead::class, 'payment_account', 'HeadCode');
    }

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class,'VNo','id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function invoiceDetails(){
        return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
    }

    public function invoice2Details(){
        return $this->hasMany(Invoice2Detail::class,'invoice_id','id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }

    public function setNetTotalAttribute($value) {
        $this->attributes['net_total'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public function setGrandTotalPriceAttribute($value) {
        $this->attributes['grand_total_price'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public function setDueAmountAttribute($value) {
        $this->attributes['due_amount'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public function setTotalDiscountAttribute($value) {
        $this->attributes['total_discount'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public function setTotalTaxAttribute($value) {
        $this->attributes['total_tax'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_sale');
                    break;
                case 'create':
                case 'store':
                    return array('create_sale');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_sale');
                    break;
                case 'delete':
                    return array('delete_sale');
                    break;
                case 'viewInvoice':
                    return array('view_sale_invoice');
                    break;
                case 'pos':
                    return array('pos_sale');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_sale',
            'create_sale',
            'edit_sale',
            'delete_sale',
            'view_sale_invoice',
            'pos_sale',
        );
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }



}
