<!-- resources/views/layouts/navigation.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo -->
        <div class="navbar-brand">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                NBN
            </a>
        </div>
        <!-- Mobile Toggle -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Centered Links -->
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <!-- Only show for admin -->
                @auth
                @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                        Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                        Proof of Payment
                    </a>
                </li>
                @endif
                @endauth
            </ul>
        </div>
        <div class="collapse ms-auto mt-2" id="navbarContent">
            @auth
            <div class="d-flex nav-item dropdown d-lg-none">
                <a class="ms-auto nav-link dropdown-toggle" href="#" id="mobileUserDropdown" role="button" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    {{-- <li><a class="ms-auto dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li> --}}
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">{{ __('Log Out') }}</a>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
        <!-- Right Side Links (Authentication Links) -->
        <div class="ms-auto d-none d-lg-block">
            @auth
            <div class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    {{-- <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li> --}}
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">{{ __('Log Out') }}</a>
                    </li>
                </ul>
            </div>
            @else
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>