<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'menu';

    protected $fillable = [
        'id',
        'menu_type',
        'menu_no',
        'menu_name',
        'menu_specific',
        'menu_add_on',
        'total_cost',
        'location_id',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function location()
    {
        return $this->belongsTo(BusinessLocation::class);
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'menu_products');
    }

    public function menuItems(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'menu_products')
            ->with('units')
            ->withPivot('quantity', 'price', 'total');
    }
}
