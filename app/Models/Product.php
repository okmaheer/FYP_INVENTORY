<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode',
        'product_name',
        'serial_no',
        'model',
        'category_id',
        'price',
        'unit',
        'image',
        'from_value',
        'to_value',
        'description',
        
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function units(){
        return $this->belongsTo(Unit::class,'unit','id');
    }

}
