<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    public function hardwareSettings(User $user) {
        return $user->ability('hardware_settings');
    }

    public function softwareSettings(User $user) {
        return $user->ability('software_settings');
    }
}
