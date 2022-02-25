<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'product_id',
        'description',
        'quantity',
        'supplier_rate',
        'rate',
        'total_price',
        'discount',
        'tax_p',
        'tax_amount',
        'discount_per',
        'status',
        'location_id',
    ];

    public function setTotalPriceAttribute($value) {
        $this->attributes['total_price'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public function invoice(){
        $this->belongsTo(Invoice::class,'invoice_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
