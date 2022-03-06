<?php

namespace App\Policies;

use App\Models\Designation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DesignationPolicy
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
     * @param  \App\Models\Designation  $designation
     * @return mixed
     */
    public function view(User $user, Designation $designation)
    {
        //
        return $user->ability('view_designation');
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
        return $user->ability('create_designation');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Designation  $designation
     * @return mixed
     */
    public function update(User $user, Designation $designation)
    {
        //
        return $user->ability('update_designation');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Designation  $designation
     * @return mixed
     */
    public function delete(User $user, Designation $designation)
    {
        //
        return $user->ability('delete_designation');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Designation  $designation
     * @return mixed
     */
    public function restore(User $user, Designation $designation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Designation  $designation
     * @return mixed
     */
    public function forceDelete(User $user, Designation $designation)
    {
        //
    }
}
