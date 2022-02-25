<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
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
        return $user->ability('view_customer');
    }

    public function create(User $user)
    {
        return $user->ability('create_customer');
    }

    public function edit(User $user)
    {
        return $user->ability('edit_customer');
    }

    public function delete(User $user)
    {
        return $user->ability('delete_customer');
    }

    public function restore(User $user, Customer $customer)
    {
        //
    }

    public function forceDelete(User $user, Customer $customer)
    {
        //
    }

    public function ledger(User $user) {
        return $user->ability('customer_ledger');
    }

    public function advance(User $user) {
        return $user->ability('customer_advance');
    }

    public function creditCustomer(User $user) {
        return $user->ability('credit_customer_list');
    }
    public function paidCustomer(User $user) {
        return $user->ability('paid_customer_list');
    }
}
