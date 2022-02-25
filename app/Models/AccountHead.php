<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
    protected $fillable = [
        'HeadCode',
        'HeadName',
        'PHeadName',
        'HeadLevel',
        'IsActive',
        'IsTransaction',
        'IsGL',
        'HeadType',
        'IsBudget',
        'IsDepreciation',
        'customer_id',
        'supplier_id',
        'pettycash_id',
        'service_id',
        'DepreciationRate',
        'location_id',
    ];
    use HasFactory;

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class,'COAID','HeadCode');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function pettycash(){
        return $this->belongsTo(User::class,'pettycash_id','id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function headCode($parent){
        $parent = $parent."000";
        $headCode =
            $this->where('HeadCode', 'like',  $parent . '%')
                ->max('HeadCode');
        if($headCode!=NULL){
            $headCode=$headCode+1;
        }else{
            $headCode=$parent."1";
        }
        return $headCode;
    }


//    public function expense_item(){
//        return $this->belongsTo(ExpenseItem::class);
//    }

}
