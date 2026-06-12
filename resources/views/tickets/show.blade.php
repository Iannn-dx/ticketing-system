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

            <div x-data="{ open: false, image: '' }" class="mt-3">
                <p class="text-xs uppercase tracking-wide text-neutral-500">
                    Attachments
                </p>

                <div class="mt-3 space-y-2">
                    @forelse ($ticket->attachments as $attachment)
                        <a href="#" class="flex items-center gap-2 text-blue-400 hover:underline"
                            @click.prevent="open = true; image = '{{ asset('storage/' . $attachment->file_path) }}'">
                            <i data-lucide="paperclip" class="h-4 w-4"></i>
                            {{ $attachment->file_name }}
                        </a>

                    @empty
                        <p class="text-sm text-neutral-500">No attachments</p>
                    @endforelse
                </div>

                <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/70">
                    <div class="relative max-w-xl w-full p-6">

                        <button @click="open = false" class="absolute top-2 left-2 text-white text-xl">
                            <i data-lucide="arrow-left"></i>
                        </button>

                        <img :src="image" class="max-h-[70vh] w-auto mx-auto rounded-lg shadow-lg object-contain">

                    </div>
                </div>
            </div>

            <div>
                <form action="{{ route('comments.store', $ticket) }}" method="POST" class="mt-4">
                    @csrf

                    <textarea name="comment" rows="3" class="w-full rounded-md border border-neutral-700 bg-neutral-900 text-white"
                        placeholder="Write a reply..." required></textarea>

                    <button type="submit"
                        class="mt-2 rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-500">
                        Send Reply
                    </button>
                </form>

                <p class="text-xs uppercase tracking-wide text-neutral-500 mt-5">Conversation</p>

                <div class="mt-3 space-y-2">
                    @forelse ($ticket->comments as $comment)
                        @if ($comment->user?->role === 'admin')
                            <div class="bg-blue-500/10 border border-blue-500/20 rounded-md p-3">
                                <p class="text-xs text-blue-400">
                                    {{ $comment->user->name }} (Admin)
                                </p>
                                <p class="mt-1 text-sm text-neutral-200">
                                    {{ $comment->comment }}
                                </p>
                                <p class="mt-2 text-xs text-neutral-500">
                                    {{ $comment->created_at->format('M j, Y g:i A') }}
                                </p>
                            </div>
                        @else
                            <div class="bg-neutral-800 rounded-md p-3">
                                <p class="text-xs text-neutral-500">
                                    {{ $comment->user?->name }}
                                </p>
                                <p class="mt-1 text-sm text-neutral-200">
                                    {{ $comment->comment }}
                                </p>
                                <p class="mt-2 text-xs text-neutral-500">
                                    {{ $comment->created_at->format('M j, Y g:i A') }}
                                </p>
                            </div>
                        @endif
                    @empty
                        <p class="text-sm text-neutral-500">
                            No replies yet.
                        </p>
                    @endforelse
                </div>
                <x-input-error :messages="$errors->get('comment')" class="mt-1">

                </x-input-error>
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
