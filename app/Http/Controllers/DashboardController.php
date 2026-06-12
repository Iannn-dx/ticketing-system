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

    // public function admin(): View|RedirectResponse
    // {
    //     // for user
    //     if (! auth()->user()->isAdmin()) {
    //         return redirect()->route('dashboard');
    //     }

    //     $user = auth()->user();

    //     $open = Ticket::where('status', 'open')->count();
    //     $closed = Ticket::where('status', 'closed')->count();
    //     $in_progress = Ticket::where('status', 'in_progress')->count();
    //     $total = Ticket::count();
    //     $totalUser = User::count();
    //     $tickets = Ticket::latest()->take(5)->get();

    //     return view('dashboard.admin', compact('open', 'closed', 'in_progress', 'total', 'totalUser', 'tickets'));
    // }

    public function dashboard(): View|RedirectResponse
{
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    $user = auth()->user();

    $open = $user->tickets()->where('status', 'open')->count();
    $in_progress = $user->tickets()->where('status', 'in_progress')->count();
    $resolved = $user->tickets()->where('status', 'closed')->count();
    $total = $user->tickets()->count();

    $tickets = $user->tickets()->latest()->take(5)->get();

    return view('dashboard.user', compact(
        'open',
        'in_progress',
        'resolved',
        'total',
        'tickets'
    ));
}

public function admin(): View|RedirectResponse
{
    if (!auth()->user()->isAdmin()) {
        return redirect()->route('dashboard');
    }

    $open = Ticket::where('status', 'open')->count();
    $closed = Ticket::where('status', 'closed')->count();
    $in_progress = Ticket::where('status', 'in_progress')->count();
    $total = Ticket::count();
    $totalUser = User::count();
    $tickets = Ticket::latest()->take(5)->get();

    return view('dashboard.admin', compact(
        'open',
        'closed',
        'in_progress',
        'total',
        'totalUser',
        'tickets'
    ));
}

    


}
