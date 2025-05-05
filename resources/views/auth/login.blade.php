<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
    <div class="mb-4 alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <p class="fw-semibold fs-4 text-white">How are you today ?</p>
        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label d-none">{{ __('Email') }}</label>
            <input id="email" type="email"
                style="background-color: #D9D9D9;width: 360px;height: 50px;"
                placeholder="Email"
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                name="email" value="{{ old('email') }}"
                required autofocus autocomplete="username">
            @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label d-none">{{ __('Password') }}</label>
            <input id="password" type="password"
                style="background-color: #D9D9D9;width: 360px;height: 50px;"
                placeholder="Password"
                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                name="password" required autocomplete="current-password">

            @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check d-flex justify-content-between">
            <div>
                <input id="remember_me" type="checkbox"
                    class="form-check-input"
                    name="remember">
                <label for="remember_me" class="form-check-label text-white">
                    {{ __('Remember me') }}
                </label>
            </div>
            @if (Route::has('password.request'))
            <a class="text-decoration-none" style="color: #FFFFFF;" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </div>

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <button type="submit" class="btn w-100 " style="height: 50px;background-color:#D9D9D9">
                {{ __('Log in') }}
            </button>
        </div>
        <div class="mt-3 d-flex justify-content-center align-items-center">
            @if (Route::has('register'))
            <a class="text-decoration-none" style="color: #FFFFFF;" href="{{ route('register') }}">
                {{ __('Dont have an account?') }}
            </a>
            @endif
        </div>
    </form>
</x-guest-layout>