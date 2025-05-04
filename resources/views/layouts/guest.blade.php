<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="bg-light">
        <div class="p-3 min-vh-100 d-flex flex-column justify-content-center align-items-center p-sm-0">
            <div class="mb-4">
                <a href="/">
                    <x-application-logo style="width: 5rem; height: 5rem;" class="text-secondary" />
                </a>
            </div>

            <div class="p-4 bg-white shadow-sm w-100 rounded-3" style="max-width: 28rem;">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>