<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function before(User $user, $ability)
    {
        return $user->role == 'admin';
    }
    public function viewAny(User $user)
    {
        return $user->role == 'admin';
    }
    public function update(User $user)
    {
        return $user->role == 'admin';
    }
}
