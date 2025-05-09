<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6Wl0s92GoPpT0wghzYM0y4SKZ4J7czXYDKiAwKAMe6he2qFMz7e8dz5Aqk" crossorigin="anonymous">

    <!-- Vite untuk file JS dan CSS lainnya -->
    @vite(['resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Hai Selamat Melakukan Pengembangan TA, Semoga Lancar Aamiin') }}</div>

                    <div class="card-body">
                        @if (Route::has('login'))
                            <div class="d-flex justify-content-between mb-3">
                                @auth
                                    <a href="{{ route('user.homepage') }}" class="btn btn-primary">{{ __('Home') }}</a>

                                    <!-- Tombol Logout -->
                                    <form method="GET" action="{{ route('logout') }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">{{ __('Logout') }}</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-secondary">{{ __('Login') }}</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-info">{{ __('Register') }}</a>
                                    @endif
                                @endauth
                            </div>
                        @endif

                        <div class="alert alert-info">
                            {{ __('Enjoy Your Trip, Wujudkan A.Md. mu itu!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0gTewfx
