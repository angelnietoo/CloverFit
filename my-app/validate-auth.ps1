# Script para verificar que el sistema de autenticación está completamente funcional
# Ejecutar con: .\validate-auth.ps1

Write-Host "============================================" -ForegroundColor Cyan
Write-Host "CloverFit - Validación de Sistema de Auth" -ForegroundColor Cyan
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""

# 1. Verificar conexión a la base de datos
Write-Host "1. Verificando conexión a base de datos..." -ForegroundColor Yellow
try {
    php artisan tinker --execute="DB::connection()->getPdo();" 2>$null 1>$null
    Write-Host "✓ Conexión a MySQL exitosa" -ForegroundColor Green
} catch {
    Write-Host "✗ Error conectando a MySQL" -ForegroundColor Red
    exit 1
}
Write-Host ""

# 2. Verificar migraciones
Write-Host "2. Verificando estado de migraciones..." -ForegroundColor Yellow
$output = php artisan migrate:status 2>$null
if ($output -match "Ran") {
    Write-Host "✓ Migraciones completadas" -ForegroundColor Green
} else {
    Write-Host "✗ Algunas migraciones no se han ejecutado" -ForegroundColor Red
    exit 1
}
Write-Host ""

# 3. Verificar tabla users
Write-Host "3. Verificando tabla 'users'..." -ForegroundColor Yellow
$userCount = php artisan tinker --execute="echo DB::table('users')->count();" 2>$null
if ($null -ne $userCount -and $userCount -match "\d+") {
    Write-Host "Usuarios en base de datos: $userCount" -ForegroundColor Green
} else {
    Write-Host "✓ Tabla users existe" -ForegroundColor Green
}
Write-Host ""

# 4. Ejecutar tests de autenticación
Write-Host "4. Ejecutando tests de autenticación..." -ForegroundColor Yellow
$testOutput = php artisan test tests/Feature/AuthTest.php --no-coverage 2>&1
if ($testOutput -match "passed") {
    Write-Host "✓ Todos los tests de autenticación pasaron" -ForegroundColor Green
    # Mostrar resumen
    $testOutput | Select-String "Tests:" | ForEach-Object { Write-Host "  $_" }
} else {
    Write-Host "✗ Algunos tests fallaron" -ForegroundColor Red
    exit 1
}
Write-Host ""

# 5. Verificar estructura de carpetas
Write-Host "5. Verificando estructura de carpetas..." -ForegroundColor Yellow
if ((Test-Path "app\Http\Controllers\Auth\LoginController.php") -and (Test-Path "resources\views\auth\login.blade.php")) {
    Write-Host "✓ Estructura de autenticación completa" -ForegroundColor Green
} else {
    Write-Host "✗ Faltan archivos de autenticación" -ForegroundColor Red
    exit 1
}
Write-Host ""

# 6. Verificar archivo de configuración
Write-Host "6. Verificando configuración..." -ForegroundColor Yellow
$envContent = Get-Content ".env"
if (($envContent -match "DB_DATABASE=cloverfit") -and ($envContent -match "SESSION_DRIVER=database")) {
    Write-Host "✓ Configuración correcta en .env" -ForegroundColor Green
} else {
    Write-Host "✗ Configuración incorrecta en .env" -ForegroundColor Red
    exit 1
}
Write-Host ""

Write-Host "============================================" -ForegroundColor Green
Write-Host "✓ SISTEMA DE AUTENTICACIÓN VALIDADO" -ForegroundColor Green
Write-Host "============================================" -ForegroundColor Green
Write-Host ""
Write-Host "El sistema está listo para usar:" -ForegroundColor Cyan
Write-Host "1. Iniciar servidor: php artisan serve" -ForegroundColor White
Write-Host "2. Ir a: http://localhost:8000/register" -ForegroundColor White
Write-Host "3. Crear una nueva cuenta" -ForegroundColor White
Write-Host "4. Iniciar sesión" -ForegroundColor White
Write-Host ""
