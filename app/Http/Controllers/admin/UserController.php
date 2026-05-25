<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::paginate(10);
        return view('dashboard.user.index', compact('users'));
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        if ($user->role == 'admin') {
            return redirect()->route('user.index')->with('error', __("You can't change Admin"));
        }
        $user->role = $validated['role'] ?? $user->role;
        $user->is_active = $validated['is_active'] ?? $user->is_active;
        $user->save();
        return redirect()->route('user.index')->with('success', __('User is Updated'));
    }
}
