<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwitterAPIController;
use App\Http\Controllers\LinkedinApiController;
use App\Http\Controllers\FacebookApiController;
use App\Http\Controllers\UnsplashApiController;

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
