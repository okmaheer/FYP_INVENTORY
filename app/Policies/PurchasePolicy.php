<?php

namespace App\Policies;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
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
     * @param  \App\Models\Purchase  $purchase
     * @return mixed
     */
    public function view(User $user)
    {
        //
        return $user->ability('view_purchase');
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
        return $user->ability('create_purchase');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Purchase  $purchase
     * @return mixed
     */
    public function edit(User $user)
    {
        //
        return $user->ability('edit_purchase');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Purchase  $purchase
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        return $user->ability('delete_purchase');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Purchase  $purchase
     * @return mixed
     */
    public function restore(User $user, Purchase $purchase)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Purchase  $purchase
     * @return mixed
     */
    public function forceDelete(User $user, Purchase $purchase)
    {
        //
    }

    public function viewInvoice(User $user)
    {
        //
        return $user->ability('view_purchase_invoice');
    }
}
