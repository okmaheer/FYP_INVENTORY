<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_name',
        'recipe_product_id',
        'recipe_cost',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function recipeDetails(){
        return $this->hasMany(RecipeDetail::class,'recipe_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'recipe_product_id','id');
    }
    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit', 'id');
    }
}
