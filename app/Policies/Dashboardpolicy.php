<?php

namespace App\Policies;

use App\Models\User;

class Dashboardpolicy
{
    public function viewAny(User $user)
    {
        return $user->role->name === 'admin';
    }
}
