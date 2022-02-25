<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpenseHeadPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user)
    {
        return $user->ability('view_expense_head');
    }

    public function create(User $user)
    {
        return $user->ability('create_expense_head');
    }

    public function edit(User $user)
    {
        return $user->ability('update_expense_head');
    }

    public function delete(User $user)
    {
        return $user->ability('delete_expense_head');
    }

}
