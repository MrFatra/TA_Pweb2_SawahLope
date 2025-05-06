<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.landing');
})->name('landing');

Route::get('/artikel', [ArtikelController::class, 'show']);

Route::get('/list-menu', [MenuController::class, 'viewList']);

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('auth.login.view');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::prefix('payment')->group(function () {
    Route::get('/beli-tiket', [PaymentController::class, 'viewBuyTicket'])->name('pay.buyTicket.view');
    Route::post('/beli-tiket', [PaymentController::class, 'buyTicket'])->name('pay.buyTicket');

    Route::get('/checkout', [PaymentController::class, 'viewCheckoutTiket'])->name('pay.ticket-checkout.view');
    Route::post('/checkout', [PaymentController::class, 'checkoutTicket'])->name('pay.ticket-checkout');
});
