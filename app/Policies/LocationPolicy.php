<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;

class LocationPolicy
{
    /**
     * Determine whether the user can view any locations.
     */
    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }
    public function viewAny(User $user): bool
    {
        return $user->role === 'staff';
    }

    /**
     * Determine whether the user can create locations.
     */
    public function create(User $user): bool
    {
        return $user->role === 'staff';
    }

    /**
     * Determine whether the user can update the location.
     */
    public function update(User $user, Location $location): bool
    {
        return $user->role === 'staff';
    }

    /**
     * Determine whether the user can delete the location.
     */
    public function delete(User $user, ?Location $location = null): bool
    {
        return false;
    }
}
