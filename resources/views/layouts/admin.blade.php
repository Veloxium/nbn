<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js']) <!-- Menyertakan asset yang diperlukan -->
</head>

<body class="font-sans antialiased">
    <!-- Navbar Admin -->
    @include('layouts.navigation') <!-- Navbar hanya untuk admin -->

    <div class="container py-4">
        @yield('content') <!-- Konten halaman admin -->
    </div>
</body>
</html>
