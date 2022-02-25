<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->ability('view_company');
    }

    public function create(User $user)
    {
        return $user->ability('create_company');
    }

    public function edit(User $user)
    {
        return $user->ability('edit_company');
    }

    public function delete(User $user)
    {
        return $user->ability('delete_company');
    }
}
