@props(['title', 'description'])

<div class="auth-stagger-item mb-4">
    <a href="/" class="text-2xl font-bold tracking-tight text-red-500">
        {{ config('app.name', 'Ticketing System') }}
    </a>
</div>

<div class="auth-stagger-item text-left">
    <h1 class="text-2xl font-semibold tracking-tight text-white">{{ $title }}</h1>
    <p class="text-sm text-neutral-400">{{ $description }}</p>
</div>
