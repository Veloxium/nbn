<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/userform', [PaymentController::class, 'userForm'])->name('payments.userform');
    Route::get('/payments/credit/{id}', [PaymentController::class, 'credit'])->name('payments.credit');
    Route::get('/payments/{payment}/proof', [PaymentController::class, 'showProofForm'])->name('payments.proof');



    // Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::post('/payments/userform', [PaymentController::class, 'store'])->name('payments.userformstore');
    Route::post('/payments/{payment}/proof', [PaymentController::class, 'uploadProof'])->name('payments.uploadProof');
});
