<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">Create Ticket</h1>
    </x-slot>

    <div class="mx-auto max-w-2xl">
        <div class="dash-card">
            <h2 class="text-lg font-semibold text-white">New support ticket</h2>
            <p class="mt-1 text-sm text-neutral-400">Describe your issue and we'll get back to you.</p>

            <form method="POST" action="{{ route('tickets.store') }}" class="mt-6 space-y-5">
                @csrf

                <div>
                    <label for="subject" class="mb-2 block text-sm font-medium text-white">Subject</label>
                    <input id="subject" type="text" name="subject" value="{{ old('subject') }}"
                        placeholder="Brief summary of your issue" required autofocus
                        class="w-full rounded-md border border-neutral-800 bg-neutral-950 px-3 py-2.5 text-sm text-white placeholder-neutral-600 focus:border-neutral-600 focus:outline-none focus:ring-1 focus:ring-neutral-600" />
                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                </div>

                <div>
                    <label for="description" class="mb-2 block text-sm font-medium text-white">Description</label>
                    <textarea id="description" name="description" rows="5" placeholder="Provide details about your concern" required
                        class="w-full rounded-md border border-neutral-800 bg-neutral-950 px-3 py-2.5 text-sm text-white placeholder-neutral-600 focus:border-neutral-600 focus:outline-none focus:ring-1 focus:ring-neutral-600">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <label for="priority" class="mb-2 block text-sm font-medium text-white">Priority</label>
                    <select id="priority" name="priority" required
                        class="w-full rounded-md border border-neutral-800 bg-neutral-950 px-3 py-2.5 text-sm text-white focus:border-neutral-600 focus:outline-none focus:ring-1 focus:ring-neutral-600">
                        <option value="low" @selected(old('priority') === 'low')>Low</option>
                        <option value="medium" @selected(old('priority', 'medium') === 'medium')>Medium</option>
                        <option value="high" @selected(old('priority') === 'high')>High</option>
                    </select>
                    <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('tickets.index') }}" class="text-sm text-neutral-400 transition hover:text-white">
                        Cancel
                    </a>
                    <button type="submit"
                        class="rounded-md bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 active:scale-[0.98]">
                        Submit Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
