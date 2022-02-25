<?php

namespace App\Models;

use AccountHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class PurchaseDetails extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'product_id',
        'purchase_id',
        'quantity',
        'rate',
        'total',
        'net_total',
        'discount',
        'tax_p',
        'tax_amount',
        'total_amount',
        'status',
        'location_id',
    ];

    public function purchase(){
        /*
         * we strict the foreign key and primary key where it will use
         */
        return $this->belongsTo(Purchase::class,'purchase_id','id');
    }
    public function product(){

        return $this->belongsTo(Product::class,'product_id','id');
    }
/*
    Need to update all accessors and mutators to new code style when app is updated to php 8+
    EXAMPLE:
    protected function totalAmount(): Attribute
    {
        return new Attribute(
            get: fn ($value) => return AccountHelper::number_format($value),
            set: fn ($value) => return str_replace(',', '', $value)
        );
    }
    */

    public function setTotalAmountAttribute($value)
    {
        $this->attributes['total_amount'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public function setTaxAmountAttribute($value)
    {
        $this->attributes['tax_amount'] = (is_null($value) ? null : str_replace(',', '', $value));
    }
}
