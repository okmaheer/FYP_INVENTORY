<?php

namespace App\Models;

use App\Models\Marquee\Booking;
use App\Models\Marquee\Stage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $dates = ['VDate'];

    protected $fillable =
    [
        'VNo',
        'Vtype',
        'VDate',
        'COAID',
        'Narration',
        'Debit',
        'Credit',
        'IsPosted',
        'is_opening',
        'created_by',
        'created_at',
        'updated_by',
        'IsAppove',
        'booking_id',
        'stage_id',
        'location_id',
        'fiscal_year_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function purchase(){
        /*
         * we strict the foreign key and primary key where it will use
         */
        return $this->belongsTo(Purchase::class,'VNo','voucher_no');
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class,'VNo','id');
    }


    public function accountHead(){
        return $this->belongsTo(AccountHead::class,'COAID','HeadCode');
    }

    public function salary(){
        return $this->belongsTo(Salary::class,'VNo','id');
    }

    public function income(){
        return $this->belongsTo(Income::class,'VNo','voucher_no');
    }
    public function expense(){
        return $this->belongsTo(Expense::class,'VNo','voucher_no');
    }

    public function booking(){
        return $this->belongsTo(Booking::class,'booking_id','id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id', 'id');
    }
    public function loan(){
        return $this->belongsTo(EmployeeLoan::class,'VNo','loan_no');
    }
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function setCreditAttribute($value) {
        $this->attributes['Credit'] = (is_null($value) ? null : str_replace(',', '', $value));
    }

    public function setDebitAttribute($value) {
        $this->attributes['Debit'] = (is_null($value) ? null : str_replace(',', '', $value));
    }
}
