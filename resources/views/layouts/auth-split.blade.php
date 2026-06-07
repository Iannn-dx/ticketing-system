<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="relative flex min-h-screen w-full flex-col md:flex-row">
            <div class="flex w-full flex-col items-center justify-center bg-black p-8 md:w-1/2">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>

            <div class="relative hidden min-h-screen w-1/2 border-l border-neutral-900 bg-neutral-950 md:block">
                <div class="absolute inset-0 bg-gradient-to-br from-neutral-900/40 via-neutral-950 to-black"></div>
            </div>
        </div>
    </body>
</html>
