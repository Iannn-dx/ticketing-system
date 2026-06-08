@props(['active' => false, 'href'])

@php
$classes = $active
    ? 'flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium bg-neutral-800 text-white'
    : 'flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-neutral-400 transition hover:bg-neutral-800/50 hover:text-white';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
