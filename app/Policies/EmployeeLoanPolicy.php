<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeLoanPolicy
{
    use HandlesAuthorization;

    public function request(User $user) {
        return $user->ability('create_loan_request');
    }

    public function requestApproval(User $user) {
        return $user->ability('approve_loan_request');
    }

    public function receive(User $user) {
        return $user->ability('receive_loan');
    }

    public function loanPayment(User $user) {
        return $user->ability('loan_payment');
    }

    public function view(User $user) {
        return $user->ability('view_loans');
    }

    public function report(User $user) {
        return $user->ability('loan_report');
    }
}
