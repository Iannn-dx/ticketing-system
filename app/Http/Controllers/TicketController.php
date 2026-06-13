<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Attachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $tickets = auth()->user()->tickets()->when($search, function($query, $search){
            $query->where('subject', 'like', "%{$search}%")->orWhere('status', 'like', "%{$search}%")->orWhere('priority', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('tickets.index', compact('tickets'));
    }

    public function create(): View
    {
        return view('tickets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->ticketRules());

        $ticket = auth()->user()->tickets()->create([
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'status' => Ticket::STATUS_OPEN,
        ]);

        if($request->hasFile('attachment')){
            $file = $request->file('attachment');
            $path = $file->store('attachment', 'public');

            Attachment::create([
                'ticket_id' => $ticket->id,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
            ]);
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket): View
    {
        $this->authorizeOwner($ticket);

        $ticket->load(['attachments', 'comments.user']);

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

        return redirect()->route('tickets.show', $ticket)->with('updated', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket): RedirectResponse
    {
        $this->authorizeOwner($ticket);

        $ticket->delete();

        return redirect()->route('tickets.index')->with('deleted', 'Ticket deleted successfully.');
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
            'attachment' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5120']
        ];
    }

    private function authorizeOwner(Ticket $ticket): void
    {
        abort_unless($ticket->user_id === auth()->id(), 403);
    }
}
