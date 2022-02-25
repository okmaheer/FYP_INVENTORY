<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncomeHeadPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) {
        //
    }

    public function view(User $user) {
        return $user->ability('view_income_head');
    }

    public function create(User $user) {
        return $user->ability('create_income_head');
    }

    public function edit(User $user) {
        return $user->ability('edit_income_head');
    }

    public function delete(User $user) {
        return $user->ability('delete_income_head');
    }

}
