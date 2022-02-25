<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    public static function modulePermissions($middleware = false, $route = null): array
    {
        return array(
            'chart_of_accounts',
            'supplier_payment_voucher',
            'customer_receive_voucher',
            'journal_voucher',
            'opening_balance_voucher',
            'cash_adjustment_voucher',
            'debit_voucher',
            'credit_voucher',
            'cash_transfer_voucher',
            'contra_voucher',
            'voucher_approval',
            'create_account_head',
        );
    }
}
