<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">Manage Users</h1>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-7">
        <div class="dash-card overflow-hidden p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-neutral-400 text-neutral-400">
                        <tr>
                            <th class="px-6 py-3 font-medium">User ID</th>
                            <th class="px-6 py-3 font-medium">Name</th>
                            <th class="px-6 py-3 font-medium">Email</th>
                            <th class="px-6 py-3 font-medium">Created At</th>
                            <th class="px-6 py-3 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-800">
                        @foreach ($users as $user)
                            <tr class="text-neutral-400">
                                <td class="px-6 py-4">
                                    <span href="#" class="font-medium text-white">
                                        {{ $user->id }}
                                    </span>
                                </td>
                                {{-- href="{{ route('admin.tickets.show', $ticket) }} --}}
                                <td class="px-6 py-4">
                                    <a href="#" class="text-neutral-400 hover:text-white">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 capitalize">{{ $user->email }}</td>
                                <td class="px-6 py-4 capitalize">{{ $user->created_at->format('M j, Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('tickets.edit', $user) }}" title="Edit ticket"
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
                                                            action="{{ route('tickets.destroy', $user) }}">
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
                <div class="px-4 py-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
