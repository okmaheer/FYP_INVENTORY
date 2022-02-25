<?php

namespace App\Models;

use AccountHelper;
use App\Models\Marquee\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $dates = ['purchase_date'];

    protected $fillable = [
        'chalan_no',
        // 'bank_id',
        'supplier_id',
        'booking_id',
       'payment_type',
        'purchase_date',
        'due_amount',
        'paid_amount',
        'grand_total_amount',
        'total_discount',
        'net_total_amount',
        'purchase_details',
        'status',
        'created_by',
        'updated_by',
        'location_id',
        'payment_account',
    ];

    public function paymentAccount() {
        return $this->belongsTo(AccountHead::class, 'payment_account', 'HeadCode');
    }

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    /**
     * @return mixed
     */
    public function purchaseDetails(){
        return $this->hasMany(PurchaseDetails::class,'purchase_id','id');
    }
    public function transactions(){
        return $this->hasMany(Transaction::class,'VNo','id');
    }

    public function booking(){
        return $this->belongsTo(Booking::class,'booking_id','id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }

    public function setGrandTotalAmountAttribute($value)
    {
        $this->attributes['grand_total_amount'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public function setNetTotalAmountAttribute($value)
    {
        $this->attributes['net_total_amount'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public function setDueAmountAttribute($value)
    {
        $this->attributes['due_amount'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_purchase');
                    break;
                case 'create':
                case 'store':
                    return array('create_purchase');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_purchase');
                    break;
                case 'delete':
                    return array('delete_purchase');
                    break;
                case 'viewInvoice':
                    return array('view_purchase_invoice');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_purchase',
            'create_purchase',
            'edit_purchase',
            'delete_purchase',
            'view_purchase_invoice',
        );
    }

}
