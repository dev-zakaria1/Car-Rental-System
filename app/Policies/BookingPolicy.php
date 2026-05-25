<?php

namespace App\Policies;

use App\Models\booking;
use App\Models\User;

class BookingPolicy
{
    /**
     * Create a new policy instance.
     */
    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }
    public function viewAny(User $user)
    {
        return $user->role == 'staff';
    }
    public function update(User $user, booking $booking)
    {
        return false;
    }
}
