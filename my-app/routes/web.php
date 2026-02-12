<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController; // Agregado
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('index');

// Rutas para autenticación
Auth::routes();

// Ruta para el formulario de contacto
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
