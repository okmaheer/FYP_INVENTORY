<?php

namespace App\Models\Marquee;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_id',
        'product_id',
        'final_quantity',
        'unit',
        'price',
        'total_amount',

    ];

    public function recipe(){
        return $this->belongsTo(Recipe::class,'recipe_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
