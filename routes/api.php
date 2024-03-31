<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnsplashApiController;

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


require __DIR__ . '/openaiinternalapi.php';
