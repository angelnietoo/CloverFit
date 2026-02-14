<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', [TaskController::class, 'index'])->name('index');

// Rutas para autenticación (login, registro, restablecimiento de contraseña, etc.)
Auth::routes();

// Ruta para el formulario de contacto
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Ruta de inicio después del login (si deseas hacer algo adicional en esta ruta)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
