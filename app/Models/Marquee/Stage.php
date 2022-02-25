<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stage extends Model
{
    use HasFactory;
    protected $table = 'stages';
    protected $dates = ['event_date'];

    protected $fillable = [
        'custom_stage_number',
        'booking_id',
        'custom_booking_number',
        'customer_id',
        'category',
        'event_time',
        'event_date',
        'booking_detail',
        'discount_total',
        'misc_discount_total',
        'grand_total',
        'total_paid_amount',
        'total_dues_amount',
        'net_total',
        'total_change_amount',
        'processing_by',
        'location_id',
        'start_time',
        'end_time',
        'care_of',
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
    public function stageDecorations(): BelongsToMany
    {
        return $this->belongsToMany(StageDecoration::class, 'booking_stage_decorations')
            ->withPivot('price', 'quantity', 'discount', 'total', 'net_total', 'details');
    }

    /**
     * @return BelongsToMany
     */
    public function seatPlannings(): BelongsToMany
    {
        return $this->belongsToMany(SeatPlanning::class, 'booking_seat_plannings')
            ->withPivot('price', 'quantity', 'discount', 'total', 'net_total', 'details');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    /**
     * @return BelongsToMany
     */
    public function transactions(){
        return $this->hasMany(Transaction::class,'booking_id','id');
    }

    public function booking(){
        return $this->belongsTo(Booking::class,'custom_booking_number','custom_booking_number');
    }

    public function maxId(){
        $data = $this->selectRaw('COALESCE(MAX(id),0)+1 as id')->first();
        $data = ($data->id > 0) ? $data->id : 1;
        return $data;
    }
}
