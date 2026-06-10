<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\View\View;

class TicketController extends Controller
{
    //
    public function index(): View{
        $tickets = Ticket::latest()->paginate(10);

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket): View{
        // $this->authorizeOwner($ticket);

        // return view('admin.tickets.show', ['ticket' => $ticket]);
       return view('admin.tickets.show', compact('ticket'));
    }
}
