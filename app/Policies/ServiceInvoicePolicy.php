<?php

namespace App\Policies;

use App\Models\ServiceInvoice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceInvoicePolicy
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
        return $user->ability('view_customer');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceInvoice  $serviceInvoice
     * @return mixed
     */
    public function view(User $user, ServiceInvoice $serviceInvoice)
    {
        //
        return $user->ability('view_Service_invoice');
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
        return $user->ability('create_Service_invoice');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceInvoice  $serviceInvoice
     * @return mixed
     */
    public function update(User $user, ServiceInvoice $serviceInvoice)
    {
        //
        return $user->ability('update_Service_invoice');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceInvoice  $serviceInvoice
     * @return mixed
     */
    public function delete(User $user, ServiceInvoice $serviceInvoice)
    {
        //
        return $user->ability('delete_Service_invoice');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceInvoice  $serviceInvoice
     * @return mixed
     */
    public function restore(User $user, ServiceInvoice $serviceInvoice)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceInvoice  $serviceInvoice
     * @return mixed
     */
    public function forceDelete(User $user, ServiceInvoice $serviceInvoice)
    {
        //
    }
}
