<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'chalan_no',
        // 'bank_id',
        'supplier_id',
        'payment_type',
        'purchase_date',
        'due_amount',
        'paid_amount',
        'grand_total_amount',
        'total_discount',
        'net_total_amount',
        'purchase_details',
        'status',
    ];

    /**
     * @return mixed
     */
    public function purchaseDetails(){
        return $this->hasMany(PurchaseDetail::class,'purchase_id','id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
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

}
