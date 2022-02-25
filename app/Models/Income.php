<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $dates = ['date'];

    protected $fillable =
    [
        'voucher_no',
        'date',
        'income_head',
        'payment_type',
        'amount',
        'description',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function transactions(){

        return $this->hasMany(Transaction::class,'VNo','voucher_no');
    }

    public function income_HeadName(){
        return $this->belongsTo(IncomeHead::class,'income_head','id');
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                    return array('view_income');
                    break;
                case 'create':
                case 'store':
                    return array('create_income');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_income');
                    break;
                case 'delete':
                    return array('delete_income');
                    break;
                case 'statement':
                    return array('income_statement');
                    break;
                case 'receipt':
                    return array('view_income_receipt');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_income',
            'create_income',
            'edit_income',
            'delete_income',
            'income_statement',
            'view_income_receipt',
        );
    }
}
