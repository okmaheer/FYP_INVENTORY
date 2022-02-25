<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    public static function modulePermissions($middleware = false, $route = null): array
    {
        return array(
            'stock_report',
            'fix_assets_stock_report',
            'today_report',
            'sales_report',
            'customer_due_report',
            'supplier_due_report',
            'cash_book',
            'purchase_report',
            'balance_sheet',
            'inventory_ledger',
            'bank_book',
            'general_ledger',
            'general_head',
            'trail_balance',
            'profit_loss',
            'cash_flow',
            'coa_print',

            'closing',
            'closing_report',
            'today_customer_receipts',
            'sales_report_user_wise',
            'shipping_cost_report',
            'purchase_report_category_wise',
            'sales_report_product_wise',
            'sales_report_category_wise',
            'sales_return_report',
            'supplier_return_report',
            'tax_report',
            'profit_report_sales_wise',
        );
    }
}
