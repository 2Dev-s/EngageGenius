<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAiController;

Route::prefix('openai')->group(function () {
    Route::prefix("post")->group(function ()  {
        Route::post('/createDesciption', [OpenAiController::class, 'index'])->name('openai.post.create');
        Route::post('/createPostFromCampain', [OpenAiController::class, 'index'])->name('openai.post.create');
    });
    Route::prefix("image")->group(function ()  {
        Route::post('/createPost', [OpenAiController::class, 'index'])->name('openai.post.create');
        Route::post('/createPostFromCampain', [OpenAiController::class, 'index'])->name('openai.post.create');
        Route::post('/createCampain', [OpenAiController::class, 'index'])->name('openai.post.create');
    });
});