<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.landing');
});

Route::get('/artikel', [ArtikelController::class, 'show']);

Route::get('/list-menu', [MenuController::class, 'viewList']);