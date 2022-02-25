<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandDetail extends Model
{
    protected $fillable = [
        'demand_id',
        'product_id',
        'quantity'
   
    ];
    use HasFactory;

    public function demand(){
        return $this->belongsTo(Demand::class,'demand_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
