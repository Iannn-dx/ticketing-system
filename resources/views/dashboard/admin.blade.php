<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">Admin Dashboard</h1>
    </x-slot>

    <div class="mx-auto max-w-6xl space-y-6">
        <div>
            <h2 class="text-2xl font-semibold text-white">Admin overview</h2>
            <p class="mt-1 text-sm text-neutral-400">Manage tickets and users across the system.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="dash-card">
                <p class="text-sm text-neutral-400">Total Tickets</p>
                <p class="mt-2 text-3xl font-semibold text-white">{{ $total }}</p>
            </div>
            <div class="dash-card">
                <p class="text-sm text-neutral-400">Open Tickets</p>
                <p class="mt-2 text-3xl font-semibold text-white">{{ $open }}</p>
            </div>
            <div class="dash-card">
                <p class="text-sm text-neutral-400">In Progress</p>
                <p class="mt-2 text-3xl font-semibold text-white">{{ $in_progress }}</p>
            </div>
            <div class="dash-card">
                <p class="text-sm text-neutral-400">Total Users</p>
                <p class="mt-2 text-3xl font-semibold text-white">{{ $totalUser }}</p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="dash-card lg:col-span-2">
                <h3 class="text-sm font-medium text-white">All Recent Tickets</h3>

                @if ($tickets->isEmpty())
                    <div
                        class="mt-6 flex flex-col items-center justify-center rounded-md border border-dashed border-neutral-800 py-12 text-center">
                        <svg class="mb-3 h-10 w-10 text-neutral-700" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <p class="text-sm text-neutral-400">No tickets in the system</p>
                        <p class="mt-1 text-xs text-neutral-600">Tickets from all users will appear here.</p>
                    </div>
                @else
                    <div class="mt-4 space-y-3">
                        @foreach ($tickets as $ticket)
                            <div
                                class="flex items-center justify-between rounded-md border border-neutral-800 bg-neutral-950 px-4 py-3">
                                <div>
                                    <p class="text-sm text-white">{{ $ticket->subject }}</p>
                                    <p class="text-xs text-neutral-500">
                                        {{ $ticket->created_at->diffForHumans() }}
                                    </p>
                                </div>

                                <span class="text-xs text-neutral-400 capitalize">
                                    {{ $ticket->status }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="dash-card">
                <h3 class="text-sm font-medium text-white">Admin Actions</h3>
                <ul class="mt-4 space-y-2">
                    <li>
                        <a href="{{ route('admin.tickets.index') }}"
                            class="flex items-center gap-3 rounded-md px-3 py-2 text-sm text-neutral-400 hover:bg-neutral-800 hover:text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            Manage All Tickets
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center gap-3 rounded-md px-3 py-2 text-sm text-neutral-400 hover:bg-neutral-800 hover:text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Manage Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 rounded-md px-3 py-2 text-sm text-neutral-400 transition hover:bg-neutral-800 hover:text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Account Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
