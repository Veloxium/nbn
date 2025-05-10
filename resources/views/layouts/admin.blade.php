<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js']) <!-- Menyertakan asset yang diperlukan -->
</head>

<body class="font-sans antialiased">
    <!-- Navbar Admin -->
    @include('layouts.navigation') <!-- Navbar hanya untuk admin -->

    <div class="container py-4">
        @yield('content') <!-- Konten halaman admin -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>