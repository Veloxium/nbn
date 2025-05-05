<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <p class="fw-semibold fs-4 text-white">Hello, What's your name ?</p>
            <label for="name" class="d-none form-label">{{ __('Name') }}</label>
            <input id="name" type="text"
                placeholder="Name"
                style="background-color: #D9D9D9;width: 360px;height: 50px;"
                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                name="name" value="{{ old('name') }}"
                required autofocus autocomplete="name">
            @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            @endif
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="d-none form-label">{{ __('Email') }}</label>
            <input id="email" type="email"
                style="background-color: #D9D9D9;width: 360px;height: 50px;"
                placeholder="Email"
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                name="email" value="{{ old('email') }}"
                required autocomplete="username">

            @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="d-none form-label">{{ __('Password') }}</label>
            <input id="password" type="password"
                style="background-color: #D9D9D9;width: 360px;height: 50px;"
                placeholder="Password"
                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                name="password" required autocomplete="new-password">

            @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="d-none form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password"
                style="background-color: #D9D9D9;width: 360px;height: 50px;"
                placeholder="Confirm Password"
                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                name="password_confirmation" required autocomplete="new-password">

            @if ($errors->has('password_confirmation'))
            <div class="invalid-feedback">
                {{ $errors->first('password_confirmation') }}
            </div>
            @endif
        </div>

        <div class="mt-4 d-flex justify-content-center align-items-center">
            <button type="submit" class="btn w-100 " style="height: 50px;background-color:#D9D9D9">
                {{ __('Register') }}
            </button>
        </div>
        <div class="mt-3 d-flex justify-content-center align-items-center">
            <a class="text-decoration-none text-white" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>