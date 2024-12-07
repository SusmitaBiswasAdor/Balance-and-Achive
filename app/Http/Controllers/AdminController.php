<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdmin()
    {
        return view('admin.index');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return redirect()->route('admin.manage-users')->with('status', 'User status updated successfully.');
    }
}
