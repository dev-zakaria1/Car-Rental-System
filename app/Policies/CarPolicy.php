<?php

namespace App\Policies;

use App\Models\User;
use App\Models\car;

class CarPolicy
{

    /**
     * Determine whether the user can view any models.
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
     * Determine whether the user can view the model.
     */
    public function view(User $user, car $car): bool
    {
        return $user->role === 'staff';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'staff';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, car $car): bool
    {
        return $user->role === 'staff';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ?car $car = null): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, car $car): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, car $car): bool
    {
        return false;
    }
}
