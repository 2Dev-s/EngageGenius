<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CampainController;
use App\Http\Controllers\TwitterAPIController;
use App\Http\Controllers\LinkedinApiController;
use App\Http\Controllers\UnsplashApiController;

Route::prefix('linkedin')->group(function () {
    Route::get('/oauth', [LinkedinApiController::class, 'getOauth'])->middleware(['auth'])->name('linkedin-oauth');
    Route::get('/callback', [LinkedinApiController::class, 'callback'])->name('linkedin-callback');
});

Route::prefix("unsplash")->group(function () {
    Route::get('/photos', [UnsplashApiController::class, 'getPhotos'])->middleware(['auth'])->name('unsplash-photos');
    Route::get('/oauth', [UnsplashApiController::class, 'getOauth'])->middleware(['auth'])->name('unsplash-oauth');
    Route::get('/callback', [UnsplashApiController::class, 'callback'])->name('unsplash-callback');
});

Route::prefix("twitter")->group(function () {
    Route::get('/oauth', [TwitterAPIController::class, 'getOauth'])->middleware(['auth'])->name('twitter-oauth');
    Route::get('/callback', [TwitterAPIController::class, 'callback'])->name('twitter-callback');
});

Route::prefix("posts")->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts');
    Route::get('/list', [PostController::class, 'list'])->name('posts.list');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/delete/{post}', [PostController::class, 'delete'])->name('posts.delete');
    Route::post('/update/{id}', [PostController::class, 'update'])->name('posts.update');
});

Route::prefix("campains")->group(function () {
    Route::get('/', [CampainController::class, 'index'])->name('campains');
    Route::get('/create', [CampainController::class, 'create'])->name('campains.create');
    Route::post('/store', [CampainController::class, 'store'])->name('campains.store');
    Route::get('/list', [CampainController::class, 'list'])->name('campains.list');
    Route::get('/edit/{campain}', [CampainController::class, 'edit'])->name('posts.edit');
    Route::post('/update/{id}', [CampainController::class, 'update'])->name('posts.update');

    Route::get('/delete/{campain}', [CampainController::class, 'delete'])->name('posts.delete');
});
