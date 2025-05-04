<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);  // Jika admin, lanjutkan request
        }

        // Jika bukan admin, alihkan ke halaman utama atau halaman lain
        return redirect('/')->with('error', 'Akses ditolak. Hanya untuk admin.');
    }
}