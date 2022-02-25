<?php

namespace App\Models\Marquee;

use App\Models\BusinessLocation;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StageQuotation extends Model
{
    use HasFactory;
    protected $table = 'stage_quotations';
    protected $dates = ['event_date'];

    protected $fillable = [
        'quot_number',
        'customer_name',
        'event_date',
        'event_time',
        'rate_per_head',
        'phone_number',
        'national_id_card',
        'address',
        'booking_detail',

        'discount_total',
        'misc_discount_total',
        'grand_total',
        'total_paid_amount',
        'total_dues_amount',
        'net_total',
        'total_change_amount',
        'location_id',
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
        return $this->belongsToMany(StageDecoration::class, 'quotation_booking_stage_decorations')
            ->withPivot('price', 'quantity', 'discount', 'total', 'net_total', 'details');
    }

    public function maxId(){
        $data = $this->selectRaw('COALESCE(MAX(id),0) as id')->first();
        $data = ($data->id > 0) ? $data->id+1 : 1;
        return $data;
    }
}
