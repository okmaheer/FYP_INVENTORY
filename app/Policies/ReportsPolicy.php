<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportsPolicy
{
    use HandlesAuthorization;

    public function stockReport(User $user) {
        return $user->ability('stock_report');
    }

    public function fixAssetReport(User $user) {
        return $user->ability('fix_assets_stock_report');
    }

    public function todayReport(User $user) {
        return $user->ability('today_report');
    }

    public function salesReport(User $user) {
        return $user->ability('sales_report');
    }

    public function customerDueReport(User $user) {
        return $user->ability('customer_due_report');
    }

    public function supplierDueReport(User $user) {
        return $user->ability('supplier_due_report');
    }

    public function cashBook(User $user) {
        return $user->ability('cash_book');
    }

    public function purchaseReport(User $user) {
        return $user->ability('purchase_report');
    }

    public function balanceSheet(User $user) {
        return $user->ability('balance_sheet');
    }

    public function inventoryLedger(User $user) {
        return $user->ability('inventory_ledger');
    }

    public function bankBook(User $user) {
        return $user->ability('bank_book');
    }

    public function generalLedger(User $user) {
        return $user->ability('general_ledger');
    }

    public function generalHead(User $user) {
        return $user->ability('general_head');
    }

    public function trailBalance(User $user) {
        return $user->ability('trail_balance');
    }

    public function profitLoss(User $user) {
        return $user->ability('profit_loss');
    }

    public function cashFlow(User $user) {
        return $user->ability('cash_flow');
    }

    public function coaPrint(User $user) {
        return $user->ability('coa_print');
    }

    public function closing(User $user) {
        return $user->ability('closing');
    }

    public function closingReport(User $user) {
        return $user->ability('closing_report');
    }

    public function todayCustomerReceipts(User $user) {
        return $user->ability('today_customer_receipts');
    }

    public function salesReportUserWise(User $user) {
        return $user->ability('sales_report_user_wise');
    }

    public function shippingCostReport(User $user) {
        return $user->ability('shipping_cost_report');
    }

    public function purchaseReportCategoryWise(User $user) {
        return $user->ability('purchase_report_category_wise');
    }

    public function salesReportProductWise(User $user) {
        return $user->ability('sales_report_product_wise');
    }

    public function salesReportCategoryWise(User $user) {
        return $user->ability('sales_report_category_wise');
    }

    public function salesReturnReport(User $user) {
        return $user->ability('sales_return_report');
    }

    public function supplierReturnReport(User $user) {
        return $user->ability('supplier_return_report');
    }

    public function taxReport(User $user) {
        return $user->ability('tax_report');
    }

    public function profitReportSalesWise(User $user) {
        return $user->ability('profit_report_sales_wise');
    }
}
