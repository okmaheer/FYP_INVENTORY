<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxPolicy
{
    use HandlesAuthorization;

    public function view(User $user) {
        return $user->ability('view_tax');
    }

    public function create(User $user) {
        return $user->ability('create_tax');
    }

    public function edit(User $user) {
        return $user->ability('edit_tax');
    }

    public function delete(User $user) {
        return $user->ability('delete_tax');
    }
}
