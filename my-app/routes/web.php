<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\PayPalController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\EntityNameController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



// Ruta principal
Route::get('/', [TaskController::class, 'index'])->name('index');

// Rutas de autenticación (login, registro, restablecimiento de contraseña, etc.)
Route::middleware('web')->group(function () {
    // Login
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    // Register
    Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);

    // Password reset
    Route::post('/password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('/password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');

    // Confirm password
    Route::get('/password/confirm', [\App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('/password/confirm', [\App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']);

    // Email verification
    Route::get('/email/verify', [\App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [\App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');
});

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

// Rutas para crear y eliminar registros Telegram
Route::post('/records', [RecordController::class, 'store']);
Route::delete('/records/{id}', [RecordController::class, 'destroy']);

// Webhook de Telegram - Sin CSRF para permitir que Telegram envíe mensajes
Route::post('/api/telegram/webhook', [\App\Http\Controllers\TelegramWebhookController::class, 'handle'])->withoutMiddleware('web');
Route::get('/api/telegram/health', [\App\Http\Controllers\TelegramWebhookController::class, 'health']);

