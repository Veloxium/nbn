<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\AdminMiddleware;

Route::middleware(['auth'])->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/userform', [PaymentController::class, 'userForm'])->name('payments.userform');
    Route::get('/payments/credit/{id}', [PaymentController::class, 'credit'])->name('payments.credit');
    Route::get('/payments/cod/{id}', [PaymentController::class, 'cod'])->name('payments.cod');
    Route::get('/payments/{payment}/proof', [PaymentController::class, 'showProofForm'])->name('payments.proof');

    Route::post('/payments/userform', [PaymentController::class, 'store'])->name('payments.userformstore');
    Route::post('/payments/{payment}/proof', [PaymentController::class, 'uploadProof'])->name('payments.uploadProof');
});



Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::resource('/payments', PaymentController::class)->names('admin.payments');

});
