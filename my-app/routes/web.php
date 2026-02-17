<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntityNameController; // Controlador para las entidades
use App\Http\Controllers\Auth\PayPalController;
use App\Http\Controllers\Admin\UserController; // Importar UserController para gestión de usuarios

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

// Rutas para la gestión de usuarios solo accesibles por administradores
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Ruta para ver el dashboard admin
    Route::get('/admin', [UserController::class, 'index'])->name('admin.dashboard');

    // Ruta para crear un nuevo usuario
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.create_user');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.store_user');

    // Rutas para editar un usuario
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.edit_user');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.update_user');

    // Ruta para eliminar un usuario
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.destroy_user');
});
