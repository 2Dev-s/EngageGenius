<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAiController;

Route::prefix('openai')->group(function () {
    Route::prefix("post")->group(function ()  {
        Route::get('/createDesciption', [OpenAiController::class, 'createPostDescription'])->name('openai.create.post.description');
/*         Route::post('/createPostFromCampain', [OpenAiController::class, 'index'])->name('openai.post.create.camplai'); */
    });

    Route::prefix("image")->group(function ()  {
        Route::get('/create', [OpenAiController::class, 'image'])->name('openai.post.create'); // http://localhost:8000/api/openai/image/createPost
    });
});