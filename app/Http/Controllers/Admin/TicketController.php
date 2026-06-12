<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Attachment;
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
        'attachment' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5120']
    ]);

    $ticket->update([
        'subject' => $validated['subject'],
        'description' => $validated['description'],
        'status' => $validated['status'],
    ]);

    if ($request->hasFile('attachment')) {

        $file = $request->file('attachment');
        $path = $file->store('attachments', 'public');

        $ticket->attachments()->create([
            'filename' => $file->getClientOriginalName(),
            'file_path' => $path,
        ]);
    }

    return redirect()
        ->route('admin.tickets.index')->with('updated', 'Ticket updated successfully.');
}

    public function destroy(Ticket $ticket): RedirectResponse{
        $ticket->delete();
        return redirect()->route('admin.tickets.index')->with('deleted', 'Ticket deleted successfully');
    }

    //     public function destroy(Ticket $ticket): RedirectResponse
    // {
    //     $this->authorizeOwner($ticket);

    //     $ticket->delete();

    //     return redirect()->route('tickets.index')->with('status', 'Ticket deleted successfully.');
    // }


}
