<?php

namespace App\Policies;

use App\Models\Person;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
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
     * @param  \App\Models\Person  $person
     * @return mixed
     */
    public function view(User $user, Person $person)
    {
        //
        return $user->ability('view_person');
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
        return $user->ability('create_person');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Person  $person
     * @return mixed
     */
    public function update(User $user, Person $person)
    {
        //
        return $user->ability('update_person');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Person  $person
     * @return mixed
     */
    public function delete(User $user, Person $person)
    {
        //
        return $user->ability('delete_person');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Person  $person
     * @return mixed
     */
    public function restore(User $user, Person $person)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Person  $person
     * @return mixed
     */
    public function forceDelete(User $user, Person $person)
    {
        //
    }
}
