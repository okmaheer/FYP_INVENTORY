<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncomePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) {
        //
    }

    public function view(User $user) {
        return $user->ability('view_income');
    }

    public function create(User $user) {
        return $user->ability('create_income');
    }

    public function edit(User $user) {
        return $user->ability('edit_income');
    }

    public function delete(User $user) {
        return $user->ability('delete_income');
    }

    public function statement(User $user) {
        return $user->ability('income_statement');
    }

    public function viewReceipt(User $user) {
        return $user->ability('view_income_receipt');
    }
}
