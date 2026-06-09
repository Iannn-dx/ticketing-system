<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-neutral-800 bg-black transition-transform duration-200 ease-in-out lg:translate-x-0"
>
    @php
        $homeRoute = Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard');
        $isDashboardActive = request()->routeIs('dashboard') || request()->routeIs('admin.dashboard');
    @endphp

    <div class="flex h-16 shrink-0 items-center border-b border-neutral-800 px-6">
        <a href="{{ $homeRoute }}" class="text-lg font-bold tracking-tight text-red-500">
            {{ config('app.name', 'Ticketing System') }}
        </a>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">
        <x-sidebar-link :href="$homeRoute" :active="$isDashboardActive" @click="sidebarOpen = false">
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </x-sidebar-link>

        @if (Auth::user()->isAdmin())
            <x-sidebar-link href="#" :active="false" class="pointer-events-none opacity-50">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                All Tickets
                <span class="ml-auto rounded bg-neutral-800 px-1.5 py-0.5 text-xs text-neutral-500">Soon</span>
            </x-sidebar-link>

            <x-sidebar-link href="#" :active="false" class="pointer-events-none opacity-50">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Users
                <span class="ml-auto rounded bg-neutral-800 px-1.5 py-0.5 text-xs text-neutral-500">Soon</span>
            </x-sidebar-link>
        @else
        {{-- pointer-events-none opacity-50 --}}
            <x-sidebar-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')" @click="sidebarOpen = false">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                My Tickets
            </x-sidebar-link>
        @endif

        <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')" @click="sidebarOpen = false">
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Profile
        </x-sidebar-link>
    </nav>

    <div class="shrink-0 border-t border-neutral-800 p-4">
        <div class="mb-3 truncate px-3">
            <p class="truncate text-sm font-medium text-white">{{ Auth::user()->name }}</p>
            <p class="truncate text-xs text-neutral-500">{{ Auth::user()->email }}</p>
            @if (Auth::user()->isAdmin())
                <p class="mt-1 text-xs font-medium uppercase tracking-wide text-red-500">Admin</p>
            @endif
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-neutral-400 transition hover:bg-neutral-800/50 hover:text-white"
            >
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Log Out
            </button>
        </form>
    </div>
</aside>
