<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}/proof', [PaymentController::class, 'showProofForm'])->name('payments.proof');
    Route::post('/payments/{payment}/proof', [PaymentController::class, 'uploadProof'])->name('payments.uploadProof');
});
