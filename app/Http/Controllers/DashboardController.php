<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function user(): View|RedirectResponse
    {
        // for admin
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $user = auth()->user();

        $open = $user->tickets()->where('status', 'open')->count();

        // return view('dashboard.user');
        return view('dashboard.user', compact('open'));
    }

    public function admin(): View|RedirectResponse
    {
        // for user
        if (! auth()->user()->isAdmin()) {
            return redirect()->route('dashboard');
        }

        $user = auth()->user();

        $open = Ticket::where('status', 'open')->count();
        $closed = Ticket::where('status', 'closed')->count();
        $total = Ticket::count();
        $totalUser = User::count();

        return view('dashboard.admin', compact('open', 'closed', 'total', 'totalUser'));
    }


}
