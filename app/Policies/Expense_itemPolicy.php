<?php

namespace App\Policies;

use App\Models\Expenseitem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Expense_itemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Expenseitem  $expenseitem
     * @return mixed
     */
    public function view(User $user, Expenseitem $expenseitem)
    {
        //
        return $user->ability('view_expense_item');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->ability('create_expense_item');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Expenseitem  $expenseitem
     * @return mixed
     */
    public function update(User $user, Expenseitem $expenseitem)
    {
        //
        return $user->ability('update_expense_item');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Expenseitem  $expenseitem
     * @return mixed
     */
    public function delete(User $user, Expenseitem $expenseitem)
    {
        //
        return $user->ability('delete_expense_item');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Expenseitem  $expenseitem
     * @return mixed
     */
    public function restore(User $user, Expenseitem $expenseitem)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Expenseitem  $expenseitem
     * @return mixed
     */
    public function forceDelete(User $user, Expenseitem $expenseitem)
    {
        //
    }
}
