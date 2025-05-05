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

Route::get('/', fn() => view('welcome'));

// Import semua modular route
require __DIR__.'/modules/auth.php';
require __DIR__.'/modules/user.php';
require __DIR__.'/modules/admin.php';
require __DIR__.'/modules/product.php';
require __DIR__.'/modules/cart.php';