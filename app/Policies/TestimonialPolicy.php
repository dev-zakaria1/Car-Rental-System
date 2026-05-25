<?php

namespace App\Policies;

use App\Models\testimonial;
use App\Models\User;

class TestimonialPolicy
{
    public function before(User $user, $ability)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }

    public function create(User $user)
    {
        return $user->role === 'staff';
    }
    public function update(User $user, testimonial $testimonial)
    {
        return $user->role === 'staff';
    }
    public function viewAny(User $user)
    {
        return $user->role === 'staff';
    }
    public function delete(User $user, ?testimonial $testimonial=null)
    {
        return false;
    }
}
