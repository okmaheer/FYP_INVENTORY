<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierPolicy
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

    public function view(User $user)
    {
        //
        return $user->ability('view_supplier');
    }

    public function create(User $user)
    {
        //
        return $user->ability('create_supplier');
    }

    public function edit(User $user)
    {
        //
        return $user->ability('edit_supplier');
    }

    public function delete(User $user)
    {
        //
        return $user->ability('delete_supplier');
    }

    public function restore(User $user, Supplier $supplier)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Supplier  $supplier
     * @return mixed
     */
    public function forceDelete(User $user, Supplier $supplier)
    {
        //
    }

    public function ledger(User $user) {
        return $user->ability('supplier_ledger');
    }

    public function advance(User $user) {
        return $user->ability('supplier_advance');
    }
}
