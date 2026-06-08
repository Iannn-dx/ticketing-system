<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">Dashboard</h1>
    </x-slot>

    <div class="mx-auto max-w-6xl space-y-6">
        <div>
            <h2 class="text-2xl font-semibold text-white">Welcome back, {{ Auth::user()->name }}</h2>
            <p class="mt-1 text-sm text-neutral-400">Track and manage your support tickets.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            <div class="dash-card">
                <p class="text-sm text-neutral-400">My Open Tickets</p>
                <p class="mt-2 text-3xl font-semibold text-white">0</p>
            </div>
            <div class="dash-card">
                <p class="text-sm text-neutral-400">In Progress</p>
                <p class="mt-2 text-3xl font-semibold text-white">0</p>
            </div>
            <div class="dash-card">
                <p class="text-sm text-neutral-400">Resolved</p>
                <p class="mt-2 text-3xl font-semibold text-white">0</p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="dash-card lg:col-span-2">
                <h3 class="text-sm font-medium text-white">My Recent Tickets</h3>
                <div
                    class="mt-6 flex flex-col items-center justify-center rounded-md border border-dashed border-neutral-800 py-12 text-center">
                    <svg class="mb-3 h-10 w-10 text-neutral-700" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    <p class="text-sm text-neutral-400">No tickets yet</p>
                    <p class="mt-1 text-xs text-neutral-600">Create a ticket to get support.</p>
                </div>
            </div>

            <div class="dash-card">
                <h3 class="text-sm font-medium text-white">Quick Actions</h3>
                <ul class="mt-4 space-y-2">
                    <li>
                        <a href="{{ route('tickets.create') }}"
                            class="flex items-center gap-3 rounded-md px-3 py-2 text-sm text-neutral-400 hover:bg-neutral-800 hover:text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Create Ticket
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 rounded-md px-3 py-2 text-sm text-neutral-400 transition hover:bg-neutral-800 hover:text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Edit Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
