<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user): View {
        return view('admin.users.edit', compact('user'));
    }

    public function destroy(User $user): RedirectResponse{
        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'User deleted successfully');
    }



}
