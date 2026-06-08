<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('landing.home');
    }

    public function about(): View
    {
        return view('landing.about');
    }
}
