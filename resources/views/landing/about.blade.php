@extends('layouts.landing')

@section('title', 'About — '.config('app.name', 'Ticketing System'))

@section('content')
    <section class="mx-auto max-w-3xl px-6 py-16 sm:py-20">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">About the system</h1>
        <p class="mt-4 text-neutral-400 leading-relaxed">
            {{ config('app.name', 'Ticketing System') }} is a support platform that helps users submit issues and lets admins manage them from a central dashboard.
        </p>

        <div class="mt-12 space-y-8">
            <div>
                <h2 class="text-lg font-semibold">What it does</h2>
                <p class="mt-2 text-sm leading-relaxed text-neutral-400">
                    Users can open tickets for help, track their status, and receive updates. Admins get a separate view to see all tickets and users across the system.
                </p>
            </div>

            <div>
                <h2 class="text-lg font-semibold">Who it's for</h2>
                <p class="mt-2 text-sm leading-relaxed text-neutral-400">
                    Built for teams and organizations that need a straightforward way to handle support requests without unnecessary complexity.
                </p>
            </div>

            <div>
                <h2 class="text-lg font-semibold">How to get started</h2>
                <p class="mt-2 text-sm leading-relaxed text-neutral-400">
                    Create an account to submit tickets, or log in if you already have one. Admin accounts are assigned separately and include access to the admin dashboard.
                </p>
            </div>
        </div>

        @guest
            <div class="mt-12">
                <a href="{{ route('register') }}" class="landing-btn-primary inline-block px-6 py-2.5">
                    Get Started
                </a>
            </div>
        @endguest
    </section>
@endsection
