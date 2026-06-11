<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
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

    public function edit(Ticket $ticket): View {
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'status' => ['required', 'in:open,in_progress,resolved,closed'],
            // 'priority' => ['required', 'in:low,medium,high,urgent'],
        ]);

        $ticket->update($validated);

        return redirect()->route('admin.tickets.index')->with('status', 'Ticket updated successfully.');
    }


}
