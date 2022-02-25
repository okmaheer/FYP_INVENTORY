<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PettyCashPolicy
{
    use HandlesAuthorization;

    public function ledger(User $user) {
        return $user->ability('pettycash_ledger');
    }
}
