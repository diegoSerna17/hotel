<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

// Ruta principal: Listar hoteles
Route::get('/', [HotelController::class, 'index'])->name('hoteles.index');

// Ruta para registrar la reserva (POST)
Route::post('/reserva', [HotelController::class, 'store'])->name('reserva.store');