<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntityNameController; //ruta del crud de la entidad
use App\Http\Controllers\EntityNameController;


// Ruta principal
Route::get('/', [TaskController::class, 'index'])->name('index');

// Rutas para autenticación (login, registro, restablecimiento de contraseña, etc.)
Auth::routes();

// Ruta para el formulario de contacto
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Ruta de inicio después del login (si deseas hacer algo adicional en esta ruta)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Rutas del recurso para la entidad
Route::resource('entities', EntityNameController::class);

Route::get('entities/restore/{id}', [EntityNameController::class, 'restore'])->name('entities.restore');

Route::get('entities/trashed', [EntityNameController::class, 'trashed'])->name('entities.trashed');



