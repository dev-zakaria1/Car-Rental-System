<?php

namespace App\Policies;

use App\Models\message;
use App\Models\User;

class MessagePolicy
{
    public function before(User $user, $ability)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }
    public function update(User $user, message $message)
    {
        return $user->role == 'staff';
    }
    public function viewAny(user $user)
    {
        return $user->role == 'staff';
    }
    public function delete(user $user, ?message $message = null)
    {
        return false;
    }
}
