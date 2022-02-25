<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'name',
            'status',
            'slug',
            'type',
            'location_id'
        ];

        public function location() {
            return $this->belongsTo(BusinessLocation::class);
        }
        
    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_category');
                    break;
                case 'create':
                case 'store':
                    return array('create_category');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_category');
                    break;
                case 'delete':
                    return array('delete_category');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_category',
            'create_category',
            'edit_category',
            'delete_category',
        );
    }

}
