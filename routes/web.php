<?php

// routes/web.php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Models\Product;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');  // Ganti dengan view lain jika diperlukan
});

// Rute untuk halaman login

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Rute untuk registrasi pengguna
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

// Group untuk admin (hanya admin yang bisa akses)
Route::middleware(['auth', adminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Group untuk user terautentifikasi
Route::middleware('auth')->group(function () {
    Route::get('/profile', fn() => view('user.profile'))->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/home', function () { 
        $products = Product::latest()->take(8)->get(); 
        return view('user.home', compact('products'));  // Halaman untuk user
    })->name('home');
});

//logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Group route untuk cart
Route::middleware(['auth'])->prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index'); // Rute untuk menampilkan cart
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');   // Rute untuk menambah produk ke cart
    Route::post('/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Rute untuk autentikasi
require __DIR__.'/auth.php';
