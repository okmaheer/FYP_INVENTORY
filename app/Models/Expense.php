<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $dates = ['date'];

    protected $fillable =
    [
        'voucher_no',
        'date',
        'expense_head',
        'payment_account',
        'amount',
        'description',
        'location_id',
        'attachment',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function transactions(){

        return $this->hasMany(Transaction::class,'VNo','voucher_no');
    }

    public function expense_HeadName(){
        return $this->belongsTo(ExpenseHead::class,'expense_head','id');
    }

    public function accountHead(){
        return $this->hasOne(AccountHead::class,'id','payment_account');
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_expense');
                    break;
                case 'create':
                case 'store':
                    return array('create_expense');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_expense');
                    break;
                case 'delete':
                    return array('delete_expense');
                    break;
                case 'statement':
                    return array('expense_statement');
                    break;
                case 'receipt':
                    return array('view_expense_receipt');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_expense',
            'create_expense',
            'edit_expense',
            'delete_expense',
            'expense_statement',
            'view_expense_receipt',
        );
    }

}
