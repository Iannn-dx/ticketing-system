<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">Edit User Details</h1>
    </x-slot>

    <div class="mx-auto max-w-2xl">
        <div class="dash-card">

            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="mt-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="subject" class="mb-2 block text-sm font-medium text-white">Name</label>
                    <input id="subject" type="text" name="subject" value="{{ old('subject', $user->name) }}"
                        placeholder="Brief summary of your issue" required autofocus
                        class="w-full rounded-md border border-neutral-800 bg-neutral-950 px-3 py-2.5 text-sm text-white placeholder-neutral-600 focus:border-neutral-600 focus:outline-none focus:ring-1 focus:ring-neutral-600" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-white">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('subject', $user->email) }}"
                        placeholder="example@gmail.com" required autofocus
                        class="w-full rounded-md border border-neutral-800 bg-neutral-950 px-3 py-2.5 text-sm text-white placeholder-neutral-600 focus:border-neutral-600 focus:outline-none focus:ring-1 focus:ring-neutral-600" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="role" class="mb-2 block text-sm font-medium text-white">Role</label>
                    <select id="role" name="role" required
                        class="w-full rounded-md border border-neutral-800 bg-neutral-950 px-3 py-2.5 text-sm text-white focus:border-neutral-600 focus:outline-none focus:ring-1 focus:ring-neutral-600">
                        <option value="user" @selected(old('role', $user->role) === 'user')>User</option>
                        <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('admin.users.index') }}"
                        class="text-sm text-neutral-400 transition hover:text-white">
                        Cancel
                    </a>
                    <button type="submit"
                        class="rounded-md bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 active:scale-[0.98]">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
