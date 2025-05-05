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

<body class="bg-light m-0">
    <div class="position-relative min-vh-100 overflow-hidden">

        <!-- Carousel as background -->
        <div id="carouselExampleSlidesOnly"
            class="carousel slide position-absolute top-0 start-0 w-100 h-100 z-n1"
            data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <img src="{{ asset('images/slide/1.png') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 1">
                </div>
                <div class="carousel-item h-100">
                    <img src="{{ asset('images/slide/2.png') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
                </div>
                <div class="carousel-item h-100">
                    <img src="{{ asset('images/slide/3.png') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 3">
                </div>
            </div>
        </div>

        <!-- Foreground content -->
        <div class="d-flex flex-column justify-content-center align-items-center min-vh-100 p-3 p-sm-0 position-relative z-1">
            <div style="max-width: 360px;">
                {{ $slot }}
            </div>
        </div>

    </div>
</body>


</html>