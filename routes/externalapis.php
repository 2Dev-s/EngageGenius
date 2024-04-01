<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwitterAPIController;
use App\Http\Controllers\LinkedinApiController;
<<<<<<< HEAD
use App\Http\Controllers\FacebookApiController;
use App\Http\Controllers\UnsplashApiController;
=======

>>>>>>> 7a1be0e9a1ae2c7becce2b5e92c36e38e427b58b

Route::prefix('linkedin')->group(function () {
    Route::get('/oauth', [LinkedinApiController::class, 'getOauth'])->middleware(['auth'])->name('linkedin-oauth');
    Route::get('/callback', [LinkedinApiController::class, 'callback'])->name('linkedin-callback');
});

Route::prefix("twitter")->group(function () {
    Route::get('/oauth', [TwitterAPIController::class, 'getOauth'])->middleware(['auth'])->name('twitter-oauth');
    Route::get('/callback', [TwitterAPIController::class, 'callback'])->name('twitter-callback');
    Route::get('/post', [TwitterAPIController::class, 'post']);
});

Route::prefix('facebook')->group(function () {
    Route::get('/oauth', [FacebookApiController::class, 'getOauth'])->middleware(['auth'])->name('facebook-oauth');
    Route::get('/callback', [FacebookApiController::class, 'callback'])->name('facebook-callback');
});
