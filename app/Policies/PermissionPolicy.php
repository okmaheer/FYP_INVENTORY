<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->ability('view_permission');
    }
    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->ability('create_permission');
    }
    /**
     * @param User $user
     * @return bool
     */
    public function edit(User $user): bool
    {
        return $user->ability('edit_permission');
    }
    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->ability('delete_permission');
    }
    /**
     * @param User $user
     * @return bool
     */
    public function show(User $user): bool
    {
        return $user->ability('show_permission');
    }
    /**
     * @param User $user
     * @return bool
     */
    public function sync(User $user): bool
    {
        return $user->ability('sync_permission');
    }
}
