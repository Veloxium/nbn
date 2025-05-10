<!-- resources/views/layouts/navigation.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            href="{{ route('admin.dashboard') }}">
            NBN
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation" id="navbarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Centered Nav Links -->
            <div class="mx-auto">
                <ul class="navbar-nav text-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    @auth
                    @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}"
                            href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.payments.index') ? 'active' : '' }}"
                            href="{{ route('admin.payments.index') }}">Proof of Payment</a>
                    </li>

                    <!-- Logout (mobile only) -->
                    <li class="nav-item d-lg-none mx-auto">
                        <form method="GET" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item nav-link text-start">{{ __('Log Out') }}</button>
                        </form>
                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </div>

        <!-- Right-side Auth (desktop only) -->
        @auth
        <div class="d-none d-lg-block ms-auto">
            <div class="nav-item dropdown">
                <button class="nav-link dropdown-toggle" id="userDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <form method="GET" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @else
        <!-- Guest Links -->
        <div class="ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
            </ul>
        </div>
        @endauth
    </div>
</nav>

<!-- JavaScript for toggle behavior -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbarToggler = document.getElementById("navbarToggle");
        const navbarContent = document.getElementById("navbarContent");

        // Toggle manually
        navbarToggler.addEventListener("click", function() {
            const isExpanded = navbarContent.classList.contains("show");
            if (isExpanded) {
                bootstrap.Collapse.getInstance(navbarContent)?.hide();
            } else {
                new bootstrap.Collapse(navbarContent);
            }
        });

        // Close navbar when clicking outside
        document.addEventListener("click", function(event) {
            const isClickInside = navbarContent.contains(event.target) || navbarToggler.contains(event.target);
            const isExpanded = navbarContent.classList.contains("show");

            if (!isClickInside && isExpanded) {
                bootstrap.Collapse.getInstance(navbarContent)?.hide();
            }
        });
    });
</script>