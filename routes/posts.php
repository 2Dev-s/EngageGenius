<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CampainController;
use App\Http\Controllers\TwitterAPIController;
use App\Http\Controllers\LinkedinApiController;
use App\Http\Controllers\UnsplashApiController;

Route::prefix("posts")->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts');
    Route::get('/list', [PostController::class, 'list'])->name('posts.list');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
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
    Route::get('/edit/{campain}', [CampainController::class, 'edit'])->name('campains.edit');
    Route::post('/update/{id}', [CampainController::class, 'update'])->name('campains.update');
    Route::get('/delete/{campain}', [CampainController::class, 'delete'])->name('campains.delete');
});
