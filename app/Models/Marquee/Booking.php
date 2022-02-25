<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Tax;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $dates = ['event_date', 'delivery_date', 'cancel_date'];

    protected $fillable = [
        'custom_booking_number',
        'customer_option',
        'sec_contact_no',
        'event_area',
        'event_date',
        'no_person',
        'event_time',
        'start_time',
        'end_time',
        'rate_per_head',
        'partition',
        'venue',
        'phone_number',
        'national_id_card',
        'address',
        'booking_detail',
        'event_type',
        'quot_id',

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
        'status',
        'parent_booking_id',
        'is_child',
        'tax_id',
        'total_tax',
        'additional_charges',
        'misc_discount_type',
        'misc_discount_value',

        'cancel_date',
        'canceled_by',
        'canceled_remarks',
        'cancel_type',
        'refund_type',
        'refund_total',
        'refund_value',
        'refund_amount',
        'refund_remain',
        'location_id',
        'meal_time',
        'care_of',
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
     * @return BelongsTo
     */
    public function canceledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'canceled_by');
    }

    /**
     * @return BelongsToMany
     */
    public function foodItems(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'booking_food_items')
            ->withPivot('price', 'quantity', 'discount', 'net_total', 'total', 'details');
    }

    /**
     * @return BelongsToMany
     */
    public function addOnFeatures(): BelongsToMany
    {
        return $this->belongsToMany(AddOnFeature::class, 'booking_add_on_features')
            ->withPivot('price', 'quantity', 'hourly', 'discount', 'net_total', 'total', 'details');
    }
    /**
     * @return BelongsToMany
     */
    public function extraFoodItems(): BelongsToMany
    {
        return $this->belongsToMany(ExtraFoodItem::class, 'booking_extra_food_items')
            ->withPivot('quantity','price', 'total', 'details');
    }

    /**
     * @return BelongsToMany
     */
    public function stageDecorations(): BelongsToMany
    {
        return $this->belongsToMany(StageDecoration::class, 'booking_stage_decorations')
            ->withPivot('price', 'quantity', 'discount', 'net_total', 'total', 'details');
    }

    /**
     * @return BelongsToMany
     */
    public function seatPlannings(): BelongsToMany
    {
        return $this->belongsToMany(SeatPlanning::class, 'booking_seat_plannings')
            ->withPivot('price', 'quantity', 'discount', 'net_total', 'total', 'details');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_option','id');
    }

    /**
     * @return BelongsToMany
     */
    public function transactions(){
        return $this->hasMany(Transaction::class,'booking_id','id');
    }

    public function maxId(){
        $data = $this->selectRaw('COALESCE(MAX(id),0)+1 as id')->first();
        $data = ($data->id > 0) ? $data->id : 1;
        return $data;
    }

    public function parentBooking() {
        return $this->belongsTo(Booking::class,'parent_booking_id','id');
    }

    public function addonBooking() {
        return $this->belongsTo(Booking::class,'id','parent_booking_id');
    }

    public function stage() {
        return $this->belongsTo(Stage::class,'booking_id', 'id');
    }

    public function stages() {
        return $this->belongsTo(Stage::class, 'id','booking_id');
    }

    public function quotation() {
        return $this->belongsTo(BookingQuotation::class,'quot_id');
    }

    public function eventAreaName($id) {
        return EventArea::find($id)->name;
    }

    public function eventAreaColor($id) {
        return EventArea::find($id)->bgColor;
    }

    public function tax() {
        return $this->belongsTo(Tax::class,'tax_id');
    }
}
