<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">User Tickets</h1>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-7">
        <div class="flex justify-content-end">
            <form method="GET" class="flex ml-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search tickets..."
                    class="h-10 w-64 rounded-l-md border border-r-0 border-neutral-700 bg-neutral-900 px-3 text-sm text-white focus:outline-none">

                @if (request('search'))
                    <a href="{{ url()->current() }}"
                        class="flex h-10 items-center rounded-r-md border border-red-600 bg-red-600 px-4 text-sm font-bold text-white hover:bg-red-700">
                        ✕
                    </a>
                @else
                    <button type="submit"
                        class="h-10 rounded-r-md border border-blue-600 bg-blue-600 px-4 text-sm font-medium text-white hover:bg-blue-700">
                        Search
                    </button>
                @endif
            </form>
        </div>
        <div class="dash-card overflow-hidden p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-neutral-400 text-neutral-400">
                        <tr>
                            <th class="px-6 py-3 font-medium">Ticket ID</th>
                            <th class="px-6 py-3 font-medium">Subject</th>
                            <th class="px-6 py-3 font-medium">Requested By</th>
                            <th class="px-6 py-3 font-medium">Priority</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 font-medium">Created At</th>
                            <th class="px-6 py-3 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-800">
                        @foreach ($tickets as $ticket)
                            <tr class="text-neutral-400">
                                <td class="px-6 py-4">
                                    <span href="#" class="font-medium text-white">
                                        {{ $ticket->id }}
                                    </span>
                                </td>
                                {{-- href="{{ route('admin.tickets.show', $ticket) }} --}}
                                <td class="px-6 py-4">
                                    <a href="/admin/tickets/{{ $ticket['id'] }}"
                                        class="text-neutral-400 hover:text-white">
                                        {{ $ticket->subject }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">{{ $ticket->user->name }}</td>
                                <td class="px-6 py-4 capitalize">{{ $ticket->priority }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $status = $ticket->status;
                                    @endphp

                                    <span
                                        class="inline-flex items-center text-xs font-medium px-3 py-1 rounded-full text-white
                                        @if ($status === 'open') bg-green-700
                                        @elseif($status === 'in_progress') bg-blue-700
                                        @elseif($status === 'closed') bg-red-700
                                        @else bg-gray-700 @endif
                                        ">
                                        {{ str_replace('_', ' ', $status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 capitalize">{{ $ticket->created_at->format('M j, Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.tickets.edit', $ticket) }}" title="Edit ticket"
                                            class="inline-flex items-center justify-center rounded-md p-2 text-neutral-400 transition hover:bg-neutral-800 hover:text-white">
                                            <span class="sr-only">Edit</span>
                                            <i data-lucide="pencil" class="h-4 w-4"></i>
                                        </a>
                                        <div x-data="{ open: false }" class="inline">
                                            <button type="button" @click="open = true" title="Delete ticket"
                                                class="inline-flex items-center justify-center rounded-md p-2 text-neutral-400 transition hover:bg-red-950 hover:text-red-400">
                                                <span class="sr-only">Delete</span>
                                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                                            </button>

                                            <div x-show="open" x-cloak
                                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">
                                                <div @click.away="open = false" x-transition
                                                    class="w-full max-w-md rounded-lg bg-neutral-900 p-6 shadow-xl">
                                                    <h2 class="text-lg font-semibold text-white">
                                                        Delete Ticket
                                                    </h2>

                                                    <p class="mt-2 text-sm text-neutral-400">
                                                        Are you sure you want to delete this ticket? This action
                                                        cannot be undone.
                                                    </p>

                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <button type="button" @click="open = false"
                                                            class="rounded-md px-4 py-2 text-sm text-neutral-300 hover:bg-neutral-800 transition">
                                                            Cancel
                                                        </button>

                                                        <form method="POST"
                                                            action="{{ route('admin.tickets.destroy', $ticket) }}">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="rounded-md bg-red-600 px-4 py-2 text-sm text-white hover:bg-red-500 transition">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div
                    class="flex flex-col gap-3 border-t border-neutral-800 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-neutral-400">
                        @if ($tickets->total() > 0)
                            Showing {{ $tickets->firstItem() }} to {{ $tickets->lastItem() }} of
                            {{ $tickets->total() }} tickets
                        @else
                            No tickets found
                        @endif
                    </p>
                    @if ($tickets->hasPages())
                        <div class="text-neutral-300">
                            {{ $tickets->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
