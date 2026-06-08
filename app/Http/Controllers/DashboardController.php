<?php

namespace App\Http\Controllers;

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

        return view('dashboard.user');
    }

    public function admin(): View|RedirectResponse
    {
        // for user 
        if (! auth()->user()->isAdmin()) {
            return redirect()->route('dashboard');
        }

        return view('dashboard.admin');
    }
}
