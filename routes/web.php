<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
Route::get('/', fn() => view('welcome'));

// Import semua modular route
require __DIR__.'/modules/auth.php';
require __DIR__.'/modules/user.php';
require __DIR__.'/modules/admin.php';
require __DIR__.'/modules/product.php';
require __DIR__.'/modules/cart.php';
