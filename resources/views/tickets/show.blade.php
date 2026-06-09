<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">Ticket Details</h1>
    </x-slot>

    <div class="mx-auto max-w-3xl space-y-6">
        @if (session('status'))
            <div class="rounded-md border border-green-800 bg-green-950/50 px-4 py-3 text-sm text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <div class="dash-card space-y-4">
            <div>
                <p class="text-xs uppercase tracking-wide text-neutral-500">Subject</p>
                <h2 class="mt-1 text-xl font-semibold text-white">{{ $ticket->subject }}</h2>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-wide text-neutral-500">Status</p>
                    <p class="mt-1 capitalize text-white">{{ str_replace('_', ' ', $ticket->status) }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-neutral-500">Priority</p>
                    <p class="mt-1 capitalize text-white">{{ $ticket->priority }}</p>
                </div>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-neutral-500">Description</p>
                <p class="mt-1 whitespace-pre-wrap text-neutral-400">{{ $ticket->description }}</p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-neutral-500">Submitted</p>
                <p class="mt-1 text-neutral-400">{{ $ticket->created_at->format('M j, Y g:i A') }}</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('tickets.index') }}" class="text-sm text-neutral-400 transition hover:text-white">
                &larr; Back to My Tickets
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('tickets.edit', $ticket) }}"
                    class="inline-flex items-center justify-center rounded-md p-2 text-neutral-400 transition hover:bg-neutral-800 hover:text-white">
                    <i data-lucide="pencil" class="h-4 w-4"></i>
                </a>
                {{-- delete  --}}
                <div x-data="{ open: false }" class="inline">
                    <button type="button" @click="open = true" title="Delete ticket"
                        class="inline-flex items-center justify-center rounded-md p-2 text-neutral-400 transition hover:bg-red-950 hover:text-red-400">
                        <span class="sr-only">Delete</span>
                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                    </button>

                    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">
                        <div @click.self="open = false" x-transition
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

                                <form method="POST" action="{{ route('tickets.destroy', $ticket) }}">
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
        </div>
    </div>
</div>
</x-app-layout>
