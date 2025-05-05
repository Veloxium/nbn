<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Models\Product;

Route::middleware('auth')->group(function () {
    Route::get('/profile', fn() => view('user.profile'))->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', function () {
        $newProducts = Product::latest()->take(4)->get();
        $allProducts = Product::latest()->get();
        return view('user.home', compact('newProducts', 'allProducts'));
    })->name('home');
});
