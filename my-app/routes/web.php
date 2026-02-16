<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntityNameController; // Controlador para las entidades

// Ruta principal
Route::get('/', [TaskController::class, 'index'])->name('index');

// Rutas de autenticación (login, registro, restablecimiento de contraseña, etc.)
Auth::routes();

// Ruta para el formulario de contacto
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Ruta para seleccionar suscripción
Route::get('/suscripcion', function () {
    return view('suscripcion');
})->name('suscripcion.seleccionar');

// Ruta para procesar el pago de suscripción
Route::post('/suscripcion/pagar', function () {
    // Aquí iría la lógica de pago
    return redirect('/')->with('success', 'Suscripción procesada correctamente');
})->name('suscripcion.pagar');

// Ruta de inicio después del login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas del recurso para las entidades
Route::resource('entities', EntityNameController::class);

// Rutas adicionales para las entidades
Route::get('entities/trashed', [EntityNameController::class, 'trashed'])->name('entities.trashed'); // Mostrar entidades eliminadas
Route::post('entities/{id}/restore', [EntityNameController::class, 'restore'])->name('entities.restore'); // Restaurar entidad eliminada
Route::delete('entities/{id}', [EntityNameController::class, 'destroy'])->name('entities.destroy'); // Eliminar entidad
