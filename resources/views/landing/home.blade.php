@extends('layouts.landing')

@section('title', config('app.name', 'Ticketing System'))

@section('content')
    <section class="mx-auto max-w-5xl px-6 py-20 text-center sm:py-28">
        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">
            Support made simple
        </h1>
        <p class="mx-auto mt-4 max-w-xl text-neutral-400">
            A ticketing system to submit, track, and resolve support requests in one place.
        </p>

        <div class="mt-10 flex flex-col items-center justify-center gap-3 sm:flex-row">
            @auth
                <a href="{{ Auth::user()->homeRoute() }}" class="landing-btn-primary px-8 py-3">
                    Go to Dashboard
                </a>
            @endauth
        </div>
    </section>

    <section class="border-t border-neutral-800 bg-neutral-950">
        <div class="mx-auto grid max-w-5xl gap-8 px-6 py-16 sm:grid-cols-3">
            <div class="text-center">
                <div class="mx-auto mb-4 flex h-10 w-10 items-center justify-center rounded-md border border-neutral-800 bg-neutral-900">
                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h2 class="font-semibold">Submit tickets</h2>
                <p class="mt-2 text-sm text-neutral-400">Create and send support requests easily.</p>
            </div>
            <div class="text-center">
                <div class="mx-auto mb-4 flex h-10 w-10 items-center justify-center rounded-md border border-neutral-800 bg-neutral-900">
                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h2 class="font-semibold">Track progress</h2>
                <p class="mt-2 text-sm text-neutral-400">Follow the status of your tickets in real time.</p>
            </div>
            <div class="text-center">
                <div class="mx-auto mb-4 flex h-10 w-10 items-center justify-center rounded-md border border-neutral-800 bg-neutral-900">
                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="font-semibold">Get resolved</h2>
                <p class="mt-2 text-sm text-neutral-400">Admins review and close tickets efficiently.</p>
            </div>
        </div>
    </section>
@endsection
