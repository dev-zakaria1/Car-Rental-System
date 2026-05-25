<?php

namespace App\Policies;

use App\Models\blog_post;
use App\Models\User;

class Blog_postPolicy
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
    public function update(User $user, blog_post $blog_post)
    {
        return $user->role === 'staff';
    }
    public function viewAny(User $user)
    {
        return $user->role === 'staff';
    }
    public function delete(User $user, blog_post $blog_post)
    {
        return $user->role ==='staff';
    }
}
