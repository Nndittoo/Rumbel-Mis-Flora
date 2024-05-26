<?php

use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\TugasController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', HomeController::class)->name('index');
    Route::get('/materi/{mapel:title}', [HomeController::class, 'show'])->name('mapel.show');

    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas');
    Route::get('/tugas/create', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/tugas/store', [TugasController::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{tugas:title}', [TugasController::class, 'show'])->name('tugas.show');
    Route::get('/tugas/{tugas}/edit', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::put('/tugas/{tugas}', [TugasController::class, 'update'])->name('tugas.update');

    Route::get('/materi', [MateriController::class, 'index'])->name('materi');
    Route::get('/{materi:slug}', [MateriController::class, 'show'])->name('materi-show');
});
