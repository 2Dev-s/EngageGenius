<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'create'])->name('home');

require __DIR__ . '/admin.php';