<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountsPolicy
{
    use HandlesAuthorization;

    public function coa(User $user) {
        return $user->ability('chart_of_accounts');
    }

    public function supplierPaymentVoucher(User $user) {
        return $user->ability('supplier_payment_voucher');
    }

    public function customerReceiveVoucher(User $user) {
        return $user->ability('customer_receive_voucher');
    }

    public function journalVoucher(User $user) {
        return $user->ability('journal_voucher');
    }

    public function openingBalanceVoucher(User $user) {
        return $user->ability('opening_balance_voucher');
    }

    public function cashAdjustmentVoucher(User $user) {
        return $user->ability('cash_adjustment_voucher');
    }

    public function debitVoucher(User $user) {
        return $user->ability('debit_voucher');
    }

    public function creditVoucher(User $user) {
        return $user->ability('credit_voucher');
    }

    public function cashTransferVoucher(User $user) {
        return $user->ability('cash_transfer_voucher');
    }

    public function contraVoucher(User $user) {
        return $user->ability('contra_voucher');
    }

    public function voucherApproval(User $user) {
        return $user->ability('voucher_approval');
    }

    public function createAccountHead(User $user) {
        return $user->ability('create_account_head');
    }

}
