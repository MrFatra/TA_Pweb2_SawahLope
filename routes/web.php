<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     $menu = App\Models\Menu::limit(4)->get();
//     $article = App\Models\Article::limit(4)->get();

//     return view('pages.landing', compact('menu', 'article'));
// })->name('landing');

// Route::get('/artikel', [ArticleController::class, 'viewList'])->name('article.list');
// Route::get('/artikel/{slug}', [ArticleController::class, 'viewArticle'])->name('article.view');

// Route::get('/list-menu', [MenuController::class, 'viewList'])->name('menu.list');
// Route::get('/panduan-peta', function () {
//     return view('pages.peta');
// })->name('map.view');

// Route::prefix('auth')->group(function () {
//     Route::get('/login', [AuthController::class, 'viewLogin'])->name('auth.login.view');
//     Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
//     Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
// });

// Route::middleware('has.ticket')->group(function () {
//     Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
//     Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
//     Route::get('/reservasi', [ReservationController::class, 'viewReservation'])->name('reservation.view');
//     Route::post('/reservasi', [PaymentController::class, 'payReservation'])->name('reservation');
// });

// Route::prefix('payment')->group(function () {
//     Route::get('/beli-tiket', [PaymentController::class, 'viewBuyTicket'])->name('pay.buyTicket.view');
//     Route::post('/beli-tiket', [PaymentController::class, 'buyTicket'])->name('pay.buyTicket');

//     Route::get('/checkout', [PaymentController::class, 'viewCheckoutTiket'])->name('pay.ticket-checkout.view');
//     Route::post('/checkout', [PaymentController::class, 'checkoutTicket'])->name('pay.ticket-checkout');
// });
