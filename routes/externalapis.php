<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalAPIEndpoints\TwitterAPIController;
use App\Http\Controllers\ExternalAPIEndpoints\FacebookApiController;
use App\Http\Controllers\ExternalAPIEndpoints\LinkedinApiController;
use App\Http\Controllers\ExternalAPIEndpoints\PinterestApiController;



Route::prefix('linkedin')->group(function () {
    Route::get('/oauth', [LinkedinApiController::class, 'oauth'])->middleware(['auth'])->name('linkedin-oauth');
    Route::get('/callback', [LinkedinApiController::class, 'callback'])->name('linkedin-callback');
    Route::get('/post', [LinkedinApiController::class, 'postPost']);
});

Route::prefix("twitter")->group(function () {
    Route::get('/oauth', [TwitterAPIController::class, 'oauth'])->middleware(['auth'])->name('twitter-oauth');
    Route::get('/callback', [TwitterAPIController::class, 'callback'])->name('twitter-callback');
    Route::get('/post/{post}', [TwitterAPIController::class, 'post']);
});

Route::prefix('facebook')->group(function () {
    Route::get('/oauth', [FacebookApiController::class, 'getOauth'])->middleware(['auth'])->name('facebook-oauth');
    Route::get('/callback', [FacebookApiController::class, 'callback'])->name('facebook-callback');
});

Route::prefix('pinterest')->group(function () {
    Route::get('/oauth', [PinterestApiController::class, 'oauth'])->middleware(['auth'])->name('pinterest-oauth');
    Route::get('/callback', [PinterestApiController::class, 'callback'])->name('pinterest-callback');
});