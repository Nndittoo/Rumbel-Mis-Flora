<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/', MateriController::class)->name('Materi');
});
