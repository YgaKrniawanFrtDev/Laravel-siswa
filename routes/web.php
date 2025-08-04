<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Siswa_controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('/home')->group(function (){
    Route::get('/siswa', [HomeController::class, 'index'])->name('home.siswa.view');
    Route::post('/api/siswa/store', [HomeController::class,'store'])->name('store.siswa.ajax');
    Route::get('/api/siswa/show', [HomeController::class,'showData'])->name('show.siswa.ajax');
    Route::put('/api/siswa/update/{id}', [HomeController::class, 'update'])->name('update.siswa.ajax');
    Route::delete('/api/siswa/delete/{id}', [HomeController::class, 'destroy'])->name('destroy.siswa.ajax');
});