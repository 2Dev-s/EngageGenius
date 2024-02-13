<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiniShopController;
use App\Http\Controllers\ShortURLController;

Route::get('/', [Controller::class, 'index'])->name('home');
Route::get('/pricing', [Controller::class, 'pricing'])->name('pricing');

Route::prefix('/short-url')->group(function () {
    Route::get('/', [ShortURLController::class, 'index'])->name('shorturl');
    Route::post('/', [ShortURLController::class, 'shortUrlStore'])->name('shortUrlStore');
});

Route::prefix('/minishop')->group(function () {
    Route::get('/', [MiniShopController::class, 'index'])->name('minishop');
    Route::post('/checkurl', [MiniShopController::class, 'checkUrl'])->name('minishop.checkUrl');
    Route::post('/order', [MiniShopController::class, 'order'])->name('minishop.order');
    Route::get('/orders', [MiniShopController::class, 'orders'])->name('minishop.orders');
});

Route::get('/{company}/{short_url}', [ShortURLController::class, 'redirectToUrl'])->name('redirectToUrl');

require __DIR__ . '/jetstream.php';

require __DIR__ . '/admin.php';
