<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $users = User::query()->when($search, function ($query, $search){
            $query->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create(): View {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'min:6'],
        'role' => ['required', 'in:user,admin'],
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user): View {
        return view('admin.users.edit', compact('user'));
    }

    public function destroy(User $user): RedirectResponse{
        $user->delete();

        return redirect()->route('admin.users.index')->with('deleted', 'User deleted successfully');
    }



}
