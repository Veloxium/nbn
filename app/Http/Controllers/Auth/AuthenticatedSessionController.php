<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request) : RedirectResponse
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

// Memeriksa kredensial login
if (Auth::attempt($request->only('email', 'password'))) {
    $request->session()->regenerate();

    // Cek peran pengguna (role)
    if (Auth::user()->role === 'admin') {
        // Jika admin, arahkan ke dashboard admin
        return redirect()->route('admin.dashboard');
    }

    // Jika user biasa, arahkan ke halaman user
    return redirect()->route('user.homepage');
}

// Jika login gagal
return back()->withErrors([
    'email' => 'The provided credentials do not match our records.',
]);
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
