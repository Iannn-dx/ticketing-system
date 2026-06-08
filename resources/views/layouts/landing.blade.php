<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Ticketing System'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen flex-col bg-black text-white">
            <header class="border-b border-neutral-800">
                <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
                    <a href="{{ route('home') }}" class="text-lg font-bold tracking-tight text-red-500">
                        {{ config('app.name', 'Ticketing System') }}
                    </a>

                    <nav class="flex items-center gap-6">
                        <a href="{{ route('home') }}" class="landing-nav-link {{ request()->routeIs('home') ? 'landing-nav-link-active' : '' }}">
                            Home
                        </a>
                        <a href="{{ route('about') }}" class="landing-nav-link {{ request()->routeIs('about') ? 'landing-nav-link-active' : '' }}">
                            About
                        </a>

                        @auth
                            <a href="{{ Auth::user()->homeRoute() }}" class="landing-btn-primary">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="landing-nav-link hidden sm:inline">
                                Log in
                            </a>
                            <a href="{{ route('register') }}" class="landing-btn-primary">
                                Get Started
                            </a>
                        @endauth
                    </nav>
                </div>
            </header>

            <main class="flex-1">
                @yield('content')
            </main>

            <footer class="border-t border-neutral-800">
                <div class="mx-auto max-w-5xl px-6 py-6 text-center text-sm text-neutral-500">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Ticketing System') }}
                </div>
            </footer>
        </div>
    </body>
</html>
