<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">Ticket Details</h1>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-3xl px-4 space-y-4">

            <a href="#" class="text-sm text-neutral-400 hover:text-white">
                ← Back
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
                        {{-- @if ($ticket->status === 'open')
                          <span
                            class="inline-flex items-center bg-green-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                            Open 
                        </span>
                        @endif --}}
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

                        <span class="px-2 py-0.5 text-xs rounded bg-red-500/20 text-red-400">
                            High
                        </span>
                    </div>
                </div>

                <div class="text-xs text-neutral-400 flex gap-4">
                    <span>John Doe</span>
                    <span>•</span>
                    <span>June 10, 2026</span>
                </div>

                <div class="bg-neutral-800/60 border border-neutral-800 rounded-md p-3">
                    <p class="text-sm text-neutral-300 leading-relaxed">
                        I reset my password but I still cannot log in. It keeps showing invalid credentials even after
                        multiple attempts.
                    </p>
                </div>

                <div class="space-y-2">

                    <div class="bg-neutral-800 rounded-md p-3">
                        <p class="text-xs text-neutral-500">User</p>
                        <p class="text-sm text-neutral-200">
                            Still not working after reset.
                        </p>
                    </div>

                    <div class="bg-blue-500/10 border border-blue-500/20 rounded-md p-3">
                        <p class="text-xs text-blue-400">Admin</p>
                        <p class="text-sm text-neutral-200">
                            We are checking your account now.
                        </p>
                    </div>
                </div>

                <div class="pt-2">
                    <textarea rows="4" placeholder="Write a reply..."
                        class="w-full rounded-md bg-neutral-800 border border-neutral-700 text-white text-sm p-3 focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>

                    <div class="flex justify-end mt-2">
                        <button class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-500 text-white rounded-md">
                            Send Reply
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
