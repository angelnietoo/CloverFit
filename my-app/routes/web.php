<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController; // Agregado
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntityNameController; //ruta del crud de la entidad
use App\Http\Controllers\EntityNameController;


Route::get('/', [TaskController::class, 'index'])->name('index');

// Rutas para autenticación
Auth::routes();

// Ruta para el formulario de contacto
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Rutas del recurso para la entidad
Route::resource('entities', EntityNameController::class);

Route::get('entities/restore/{id}', [EntityNameController::class, 'restore'])->name('entities.restore');

Route::get('entities/trashed', [EntityNameController::class, 'trashed'])->name('entities.trashed');



