<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('search');
Route::post('/search', [UserController::class, 'search'])->name('ajax.search');