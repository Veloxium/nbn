<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - NBN</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS (optional) -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        /* Menempatkan navbar items (Home, Products, Cart) di tengah */
        .navbar-nav.center-nav {
            display: flex;
            justify-content: center;
            /* Menyebarkan item navbar ke tengah */
            flex-grow: 1;
            /* Membuat navbar membesar agar posisi menu di tengah */
        }

        /* Memastikan bahwa navbar items yang lainnya tetap di kanan */
        .navbar-nav.ml-auto {
            margin-left: auto;
        }

        /* Hover efek untuk nav-link */
        .nav-link:hover {
            background-color: #f0f0f0;
            /* Efek hover saat cursor di atas item */
        }

        .card-text {
            text-align: justify;
            /* Justify deskripsi produk */
        }

        /* Menambahkan justify alignment pada deskripsi produk */
    </style>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid mx-4">

            <a class="navbar-brand fw-semibold fs-2 d-flex justify-content-center align-items-center gap-2" href="{{ route('user.homepage') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
                NBN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Navbar Menu Items (Center Alignment for Home, Products, Cart) -->
                <ul class="navbar-nav center-nav">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('user.homepage')) active @endif" href="{{ route('user.homepage') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('user.homepage')) active @endif" href="{{ route('user.homepage') }}#new-products">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('payment.create')) active @endif" href="{{ route('payments.index') }}">Payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            🛒 Cart
                            @auth
                            <span class="badge bg-danger">
                                {{ \App\Models\Cart::where('user_id', auth()->id())->count() }}
                            </span>
                            @endauth
                        </a>
                    </li>

                </ul>

                <!-- Navbar Items (Right Alignment for Logout/Login) -->
                <ul class="navbar-nav ms-auto ml-auto">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <main>
        @yield('content')

    </main>

    <!-- Footer Section -->
    <footer class="bg-light text-dark py-4 mt-5">
        <div class="container">
            <!-- Upper Section: Left Text & Right Contact Info -->
            <div class="row">
                <!-- Left Section: Text -->
                <div class="col-md-8">
                    <h5>Don’t Miss Out on Our Latest Updates And Exclusive Offers</h5>
                </div>
                <!-- Right Section: Contact Info -->
                <div class="col-md-4 text-md-right">
                    <p>Contact Us:
                        <a href="https://instagram.com" target="_blank" class="text-dark mx-2">Instagram</a> |
                        <a href="https://whatsapp.com" target="_blank" class="text-dark mx-2">WhatsApp</a> |
                        <a href="mailto:info@nbn.com" class="text-dark mx-2">Email</a>
                    </p>
                </div>
            </div>

            <!-- Bottom Section: Subscribe Button -->
            <div class="row mt-2">
                <div class="col-md-12">
                    <button class="btn btn-dark">Subscribe</button>
                </div>
            </div>
        </div>
    </footer>
    <!-- ✅ Bootstrap 5 Bundle: sudah termasuk Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
