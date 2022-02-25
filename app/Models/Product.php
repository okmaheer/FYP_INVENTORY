<?php

namespace App\Models;

use App\Models\Marquee\Booking;
use App\Models\Marquee\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit', 'id');
    }

    public function suppliers()
    {
        /*
         * pivot will be use when we will extract the additional data from many to many except of foreign key
         */
        return $this->belongsToMany(Supplier::class, 'supplier_products')->select('supplier_products.supplier_price', 'supplier_products.supplier_id as supplier_id');
    }


    public function purchaseDetail()
    {
        return $this->hasMany(PurchaseDetails::class, 'product_id', 'id');
    }

    public function invoiceDetails()
    {

        return $this->hasMany(InvoiceDetail::class, 'product_id', 'id');
    }

    public function invoice2Details(){

        return $this->hasMany(Invoice2Detail::class,'product_id','id');
    }
    
    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'product_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_products');
    }

    /**
     * @return BelongsToMany
     */
    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(Booking::class, 'booking_food_items', 'booking_id', 'id');
    }

    public function demandDetails(){
        return $this->hasMany(DemandDetail::class,'product_id','id');
    }


    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_product');
                    break;
                case 'create':
                case 'store':
                    return array('create_product');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_product');
                    break;
                case 'delete':
                    return array('delete_product');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_product',
            'create_product',
            'edit_product',
            'delete_product',
        );
    }

}
