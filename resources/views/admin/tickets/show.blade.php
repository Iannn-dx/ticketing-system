<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">Ticket Details</h1>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-3xl px-4 space-y-4">

            <a href="{{ route('admin.tickets.index') }}"
                class=" flex gap-1 align-items-center text-sm text-neutral-400 hover:text-white">
                <i data-lucide="arrow-left" class="w-7 h-7"></i>
            </a>

            <div class="bg-neutral-900 border border-neutral-800 rounded-lg p-5 space-y-4">

                <div class="flex justify-between items-start gap-4">
                    <div>
                        <p class="text-xs text-neutral-500">{{ $ticket->id }}</p>
                        <h2 class="text-white font-semibold">
                            {{ $ticket->subject }}
                        </h2>
                    </div>

                    <div class="flex flex-col items-end gap-1">
                        @switch($ticket->status)
                            @case('open')
                                <span
                                    class="inline-flex items-center bg-blue-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                    Open
                                </span>
                            @break

                            @case('in_progress')
                                <span
                                    class="inline-flex items-center bg-yellow-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                    In Progress
                                </span>
                            @break

                            @case('closed')
                                <span
                                    class="inline-flex items-center bg-red-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                    Closed
                                </span>
                            @break

                            @case('resolved')
                                <span
                                    class="inline-flex items-center bg-green-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                    Open
                                </span>
                            @break

                            @default
                        @endswitch

                        @switch($ticket->priority)
                            @case('urgent')
                                <span class="px-2 py-0.5 text-xs rounded bg-purple-500/20 text-purple-400">
                                    Urgent
                                </span>
                            @break

                            @case('high')
                                <span class="px-2 py-0.5 text-xs rounded bg-red-500/20 text-red-400">
                                    High
                                </span>
                            @break

                            @case('medium')
                                <span class="px-2 py-0.5 text-xs rounded bg-yellow-500/20 text-yellow-400">
                                    Medium
                                </span>
                            @break

                            @case('low')
                                <span class="px-2 py-0.5 text-xs rounded bg-green-500/20 text-green-400">
                                    Low
                                </span>
                            @break

                            @default
                                <span class="px-2 py-0.5 text-xs rounded bg-gray-500/20 text-gray-400">
                                    Unknown
                                </span>
                        @endswitch
                    </div>
                </div>

                <div class="text-md text-neutral-400 flex gap-4">
                    <span>{{ $ticket->user->name }}</span>
                    <span>•</span>
                    <span>{{ $ticket->created_at->format('M j, Y') }}</span>
                </div>

                <div class="bg-neutral-800/60 border border-neutral-800 rounded-md p-3">
                    <p class="text-md text-neutral-300 leading-relaxed">
                        {{ $ticket->description }}
                    </p>
                </div>

                <div class="space-y-2">
                    @foreach ($ticket->comments as $comment)
                        @if ($comment->user->role === 'admin')
                            <div class="bg-blue-500/10 border border-blue-900/20 rounded-md p-3">
                                <p class="text-xs text-blue-400">
                                    {{ $comment->user->name }} (Admin)
                                </p>
                                <p class="text-sm text-neutral-200">
                                    {{ $comment->comment }}
                                </p>
                            </div>
                        @else
                            <div class="bg-neutral-800 rounded-md p-3">
                                <p class="text-xs text-neutral-400">
                                    {{ $comment->user->name }}
                                </p>
                                <p class="text-sm text-neutral-200">
                                    {{ $comment->comment }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="pt-2">
                    <form action="{{ route('comments.store', $ticket) }}" method="POST">
                        @csrf

                        <textarea name="comment" rows="4" placeholder="Write a reply..."
                            class="w-full rounded-md bg-neutral-800 border border-neutral-700 text-white text-sm p-3 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            required></textarea>
                            <x-input-error :messages="$errors->get('comment')" class="mt-1">

                            </x-input-error>

                        <div class="flex justify-end mt-2">
                            <button type="submit"
                                class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-500 text-white rounded-md">
                                Send Reply
                            </button>
                        </div>

                        <div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
