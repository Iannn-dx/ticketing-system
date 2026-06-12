<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-white">Edit Ticket</h1>
    </x-slot>

    <div class="mx-auto max-w-2xl">
        <div class="dash-card">
            <h2 class="text-lg font-semibold text-white">Update ticket</h2>
            <p class="mt-1 text-sm text-neutral-400">Make changes to your support request.</p>

            <form method="POST" action="{{ route('tickets.update', $ticket) }}" class="mt-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="subject" class="mb-2 block text-sm font-medium text-white">Subject</label>
                    <input id="subject" type="text" name="subject" value="{{ old('subject', $ticket->subject) }}"
                        placeholder="Brief summary of your issue" required autofocus
                        class="w-full rounded-md border border-neutral-800 bg-neutral-950 px-3 py-2.5 text-sm text-white placeholder-neutral-600 focus:border-neutral-600 focus:outline-none focus:ring-1 focus:ring-neutral-600" />
                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                </div>

                <div>
                    <label for="description" class="mb-2 block text-sm font-medium text-white">Description</label>
                    <textarea id="description" name="description" rows="5" placeholder="Provide details about your concern" required
                        class="w-full rounded-md border border-neutral-800 bg-neutral-950 px-3 py-2.5 text-sm text-white placeholder-neutral-600 focus:border-neutral-600 focus:outline-none focus:ring-1 focus:ring-neutral-600">{{ old('description', $ticket->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <label for="priority" class="mb-2 block text-sm font-medium text-white">Priority</label>
                    <select id="priority" name="priority" required
                        class="w-full rounded-md border border-neutral-800 bg-neutral-950 px-3 py-2.5 text-sm text-white focus:border-neutral-600 focus:outline-none focus:ring-1 focus:ring-neutral-600">
                        <option value="low" @selected(old('priority', $ticket->priority) === 'low')>Low</option>
                        <option value="medium" @selected(old('priority', $ticket->priority) === 'medium')>Medium</option>
                        <option value="high" @selected(old('priority', $ticket->priority) === 'high')>High</option>
                    </select>
                    <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-white">
                        Attachments
                    </label>

                    <div x-data="{ open: false, image: '' }">

                        <div class="space-y-2 mb-3">
                            @forelse ($ticket->attachments as $attachment)
                                <div
                                    class="flex items-center justify-between rounded-md border border-neutral-800 bg-neutral-900 px-3 py-2">

                                    <a href="#"
                                        @click.prevent="open = true; image = '{{ asset('storage/' . $attachment->file_path) }}'"
                                        class="flex items-center gap-2 text-blue-400 hover:underline">

                                        <i data-lucide="paperclip" class="h-4 w-4"></i>

                                        {{ $attachment->file_name }}

                                    </a>

                                    <span class="text-xs text-neutral-500">
                                        existing
                                    </span>

                                </div>
                            @empty
                                <p class="text-sm text-neutral-500">No attachments</p>
                            @endforelse
                        </div>

                        <div x-show="open" x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/70">

                            <div class="relative max-w-xl w-full p-6">

                                <button @click="open = false" class="absolute top-2 right-2 text-white text-xl">
                                     <i data-lucide="arrow-left"></i>
                                </button>

                                <img :src="image"
                                    class="max-h-[70vh] w-auto mx-auto rounded-lg shadow-lg object-contain">
                            </div>
                        </div>

                    </div>

                    <input type="file" name="attachment" accept="image/*"
                        class="w-full rounded-md border border-neutral-800 bg-neutral-950 px-3 py-2.5 text-sm text-white file:mr-4 file:rounded-md file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-white hover:file:bg-blue-700">

                    <p class="mt-1 text-xs text-neutral-500">
                        Upload a new image (optional)
                    </p>

                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('tickets.show', $ticket) }}"
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
