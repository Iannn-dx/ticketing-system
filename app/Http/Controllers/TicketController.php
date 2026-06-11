<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(): View
    {
        $tickets = auth()->user()->tickets()->latest()->get();

        return view('tickets.index', compact('tickets'));
    }

    public function create(): View
    {
        return view('tickets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->ticketRules());

        auth()->user()->tickets()->create([
            ...$validated,
            'status' => Ticket::STATUS_OPEN,
        ]);

        return redirect()->route('tickets.index')->with('status', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket): View
    {
        $this->authorizeOwner($ticket);

        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket): View
    {
        $this->authorizeOwner($ticket);

        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorizeOwner($ticket);

        $ticket->update($request->validate($this->ticketRules()));

        return redirect()->route('tickets.show', $ticket)->with('status', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket): RedirectResponse
    {
        $this->authorizeOwner($ticket);

        $ticket->delete();

        return redirect()->route('tickets.index')->with('status', 'Ticket deleted successfully.');
    }

    /**
     * @return array<string, array<int, string>>
     */
    private function ticketRules(): array
    {
        return [
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'priority' => ['required', 'in:low,medium,high'],
        ];
    }

    private function authorizeOwner(Ticket $ticket): void
    {
        abort_unless($ticket->user_id === auth()->id(), 403);
    }
}
