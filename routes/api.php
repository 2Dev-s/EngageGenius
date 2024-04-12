<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalAPIEndpoints\OpenAiController;
use App\Http\Controllers\ExternalAPIEndpoints\UnsplashApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("unsplash")->group(function () {
    Route::get('/search', [UnsplashApiController::class, 'search'])->name('unsplash.search');
    Route::get('/oauth', [UnsplashApiController::class, 'getOauth'])->name('unsplash.oauth');
    Route::get('/callback', [UnsplashApiController::class, 'callback'])->name('unsplash.callback');
});

Route::prefix('openai')->group(function () {
    Route::prefix("post")->group(function ()  {
        Route::get('/createDesciption', [OpenAiController::class, 'createPostDescription'])->name('openai.create.post.description');
/*         Route::post('/createPostFromCampain', [OpenAiController::class, 'index'])->name('openai.post.create.camplai'); */
    });

    Route::prefix("image")->group(function ()  {
        Route::get('/create', [OpenAiController::class, 'image'])->name('openai.post.create'); // http://localhost:8000/api/openai/image/createPost
    });
});

