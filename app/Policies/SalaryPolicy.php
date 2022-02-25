<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalaryPolicy
{
    use HandlesAuthorization;

    public function view(User $user) {
        return $user->ability('view_salary');
    }

    public function create(User $user) {
        return $user->ability('create_salary');
    }

    public function delete(User $user) {
        return $user->ability('delete_salary');
    }

    public function salaryPayment(User $user) {
        return $user->ability('salary_payment');
    }

    public function salaryPayslip(User $user) {
        return $user->ability('salary_payslip');
    }

    public function advanceSalary(User $user) {
        return $user->ability('advance_salary');
    }
}
