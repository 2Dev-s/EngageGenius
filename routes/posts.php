<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CampainController;


Route::prefix("posts")->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts');
    Route::get('/list', [PostController::class, 'list'])->name('posts.list');
    Route::get('/create', [PostController::class, 'create'])->middleware(["cors"])->name('posts.create');
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
    Route::get('/edit/{campain}', [CampainController::class, 'edit'])->name('campains.edit');
    Route::post('/update/{id}', [CampainController::class, 'update'])->name('campains.update');
    Route::get('/delete/{campain}', [CampainController::class, 'delete'])->name('campains.delete');
    Route::get('/generate/{campain}', [CampainController::class, 'generatePosts'])->name('campains.generate.post');
});
