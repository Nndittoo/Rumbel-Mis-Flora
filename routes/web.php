<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', HomeController::class)->name('index');
    Route::get('/materi', [MateriController::class, 'index'])->name('materi');
    Route::get('/tugas', [MateriController::class, 'index'])->name('tugas');
    Route::get('/{materi:slug}', [MateriController::class, 'show'])->name('materi-show');
    Route::get('/materi/{mapel:title}', [HomeController::class, 'show'])->name('mapel.show');
});
