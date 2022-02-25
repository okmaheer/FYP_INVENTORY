<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BookingQuotation extends Model
{
    use HasFactory;
    protected $table = 'booking_quotations';
    protected $dates = ['event_date', 'delivery_date'];

    protected $fillable = [
        'quot_number',
        'customer_name',
        'phone_number',
        'customer_address',
        'event_area',
        'event_date',
        'no_person',
        'event_time',
        'start_time',
        'end_time',
        'rate_per_head',
        'partition',
        'venue',
        'booking_detail',
        'event_type',

        'delivery_date',
        'delivery_time',
        'delivery_address',
        'delivery_charges',

        'discount_total',
        'misc_discount_total',
        'grand_total',
        'total_paid_amount',
        'total_previous_amount',
        'total_dues_amount',
        'net_total',
        'total_change_amount',
        'parent_booking_id',
        'is_child',
        'location_id',
    ];

    protected $casts = [
        'venue' => 'array',
    ];

    public function location()
    {
        return $this->belongsTo(BusinessLocation::class);
    }

    /**
     * @return BelongsTo
     */
    public function processingBY(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processing_by');
    }

    /**
     * @return BelongsTo
     */
    public function confirmedBY(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }


    /**
     * @return BelongsToMany
     */
    public function foodItems(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'quotation_booking_food_items')
            ->withPivot('price', 'quantity', 'discount', 'total', 'net_total', 'details');
    }

    /**
     * @return BelongsToMany
     */
    public function addOnFeatures(): BelongsToMany
    {
        return $this->belongsToMany(AddOnFeature::class, 'quotation_booking_add_on_features')
            ->withPivot('price', 'quantity', 'hourly', 'discount', 'total', 'net_total', 'details');
    }

    /**
     * @return BelongsToMany
     */
    public function extraFoodItems(): BelongsToMany
    {
        return $this->belongsToMany(ExtraFoodItem::class, 'quotation_booking_extra_food_items')
            ->withPivot('price', 'quantity', 'total', 'details');
    }

    /**
     * @return BelongsToMany
     */
    public function seatPlannings(): BelongsToMany
    {
        return $this->belongsToMany(SeatPlanning::class, 'quotation_booking_seat_plannings')
            ->withPivot('price', 'quantity', 'discount', 'total', 'net_total', 'details');
    }

    public function maxId(){
        $data = $this->selectRaw('COALESCE(MAX(id),0) as id')->first();
        $data = ($data->id > 0) ? $data->id + 1 : 1;
        return $data;
    }

    public function eventAreaName($id) {
        return EventArea::find($id)->name;
    }

    public function eventAreaColor($id) {
        return EventArea::find($id)->bgColor;
    }

}
