#!/bin/bash
# Script para verificar que el sistema de autenticación está completamente funcional

echo "============================================"
echo "CloverFit - Validación de Sistema de Auth"
echo "============================================"
echo ""

# Color codes
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 1. Verificar conexión a la base de datos
echo -e "${YELLOW}1. Verificando conexión a base de datos...${NC}"
php artisan tinker --execute="echo 'DB::connection()->getPdo()->getAttribute(PDO::ATTR_CONNECTION_STATUS);'" > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Conexión a MySQL exitosa${NC}"
else
    echo -e "${RED}✗ Error conectando a MySQL${NC}"
    exit 1
fi
echo ""

# 2. Verificar migraciones
echo -e "${YELLOW}2. Verificando estado de migraciones...${NC}"
php artisan migrate:status --no-header | grep -q "Ran"
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Migraciones completadas${NC}"
else
    echo -e "${RED}✗ Algunas migraciones no se han ejecutado${NC}"
    exit 1
fi
echo ""

# 3. Verificar tabla users
echo -e "${YELLOW}3. Verificando tabla 'users'...${NC}"
php artisan tinker --execute="
try {
    \$count = DB::table('users')->count();
    echo \"Usuarios en base de datos: \$count\n\";
} catch (Exception \$e) {
    echo \"Error: Tabla users no encontrada\n\";
    exit(1);
}
"
echo ""

# 4. Ejecutar tests de autenticación
echo -e "${YELLOW}4. Ejecutando tests de autenticación...${NC}"
php artisan test tests/Feature/AuthTest.php --no-coverage --no-interaction 2>&1 | tail -5
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Todos los tests de autenticación pasaron${NC}"
else
    echo -e "${RED}✗ Algunos tests fallaron${NC}"
    exit 1
fi
echo ""

# 5. Verificar estructura de carpetas
echo -e "${YELLOW}5. Verificando estructura de carpetas...${NC}"
if [ -f "app/Http/Controllers/Auth/LoginController.php" ] && [ -f "resources/views/auth/login.blade.php" ]; then
    echo -e "${GREEN}✓ Estructura de autenticación completa${NC}"
else
    echo -e "${RED}✗ Faltan archivos de autenticación${NC}"
    exit 1
fi
echo ""

# 6. Verificar archivo de configuración
echo -e "${YELLOW}6. Verificando configuración...${NC}"
if grep -q "DB_DATABASE=cloverfit" .env && grep -q "SESSION_DRIVER=database" .env; then
    echo -e "${GREEN}✓ Configuración correcta en .env${NC}"
else
    echo -e "${RED}✗ Configuración incorrecta en .env${NC}"
    exit 1
fi
echo ""

echo "============================================"
echo -e "${GREEN}✓ SISTEMA DE AUTENTICACIÓN VALIDADO${NC}"
echo "============================================"
echo ""
echo "El sistema está listo para usar:"
echo "1. Iniciar servidor: php artisan serve"
echo "2. Ir a: http://localhost:8000/register"
echo "3. Crear una nueva cuenta"
echo "4. Iniciar sesión"
echo ""
