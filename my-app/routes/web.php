<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntityNameController; //ruta del crud de la entidad



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

// Ruta para procesar el pago de suscripción (PayPal)
Route::post('/suscripcion/pagar', [PayPalController::class, 'pay'])->name('suscripcion.pagar');

// Callbacks de PayPal
Route::get('/suscripcion/pago/execute', [PayPalController::class, 'execute'])->name('suscripcion.execute');
Route::get('/suscripcion/pago/cancel', [PayPalController::class, 'cancel'])->name('suscripcion.cancel');

// Ruta de inicio después del login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas del recurso para las entidades
Route::resource('entities', EntityNameController::class);

// Rutas adicionales para las entidades
Route::get('entities/trashed', [EntityNameController::class, 'trashed'])->name('entities.trashed'); // Mostrar entidades eliminadas
Route::post('entities/{id}/restore', [EntityNameController::class, 'restore'])->name('entities.restore'); // Restaurar entidad eliminada
Route::delete('entities/{id}', [EntityNameController::class, 'destroy'])->name('entities.destroy'); // Eliminar entidad

use App\Http\Controllers\RecordController;

// Rutas para crear y eliminar registros Telegram
Route::post('/records', [RecordController::class, 'store']);
Route::delete('/records/{id}', [RecordController::class, 'destroy']);
