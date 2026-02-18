# Sistema de Notificaciones de Telegram - CloverFit

## 📋 Descripción General

Este sistema envía notificaciones automáticas a Telegram cuando ocurren eventos en la base de datos (creación, actualización y eliminación de registros).

## ✅ Componentes Configurados

### 1. **TelegramService** (`app/Services/TelegramService.php`)
Servicio central que maneja toda la comunicación con Telegram:
- `sendMessage()` - Envía mensajes genéricos
- `notifyCreation()` - Notifica creación de registros ✅ Mejorado
- `notifyUpdate()` - Notifica actualización de registros ✅ Mejorado
- `notifyDeletion()` - Notifica eliminación de registros ✅ Mejorado
- `notifyError()` - Notifica errores en la aplicación ✅ Mejorado
- `validateConfiguration()` - Valida que todo esté configurado ✨ NUEVO
- `getConfigurationStatus()` - Obtiene el estado de la configuración ✨ NUEVO
- Incluye manejo de errores y logging mejorado

### 2. **Observers Creados**

Los observers monitorean automáticamente los cambios en los modelos:

- **UserObserver** - Monitorea cambios en usuarios
- **ActivitiesObserver** - Monitorea cambios en actividades
- **MembersObserver** - Monitorea cambios en miembros
- **EntityNameObserver** - Monitorea cambios en entidades

### 3. **Configuración en AppServiceProvider**

Los observers están registrados automáticamente en el método `boot()`.

### 4. **Comando de Testing** ✨ NUEVO
- `TestTelegramNotification` - Comando artisan para probar el sistema
  - Valida automáticamente la configuración
  - Envía mensajes de prueba
  - Proporciona instrucciones claras si falta configuración

## 🔧 Configuración del .env

Asegúrate de tener estas variables en tu `.env`:

```
TELEGRAM_BOT_TOKEN=8436319300:AAG2nzt4acWlDS9IN3xQUChZfIFg7nTFD54
TELEGRAM_CHAT_ID=1509752076
```

## 🎯 Cómo Funciona

Cuando creas, actualizas o eliminas un registro de cualquier modelo que tiene un observer, automáticamente se envía un mensaje a Telegram con:
- Tipo de evento (✅ Creado, 🔄 Actualizado, 🗑️ Eliminado)
- ID del registro
- Nombre/título del registro
- Fecha y hora
- Nombre de la aplicación

**Ejemplo de mensaje mejorado:**
```
✅ Nuevo Usuario Creado

📌 ID: 5
📝 Nombre: Juan Pérez
📊 Modelo: User
⏰ Fecha: 2026-02-17 14:30:45
🌐 Aplicación: CloverFit
```

## 🚀 Pruebas Rápidas

### Verificar que todo está configurado correctamente:

```bash
php artisan telegram:test
```

Esto mostrará:
- ✓ Si el bot está inicializado
- ✓ Si el token está configurado
- ✓ Si el chat ID está configurado
- ✓ Envía un mensaje de prueba si todo está bien
- ✓ Da instrucciones claras si falta configuración

### Pruebas específicas:

```bash
# Probar notificación de creación
php artisan telegram:test --type=creation

# Probar notificación de actualización  
php artisan telegram:test --type=update

# Probar notificación de eliminación
php artisan telegram:test --type=deletion

# Probar notificación de error
php artisan telegram:test --type=error

# Probar mensaje personalizado
php artisan telegram:test --type=custom

# Ejecutar todas las pruebas
php artisan telegram:test --type=all
```

## 🚀 Cómo Agregar Notificaciones a Otros Modelos

Si quieres agregar notificaciones a otro modelo (por ejemplo, `Payments`):

### Paso 1: Crear el Observer
```bash
php artisan make:observer PaymentsObserver --model=Payments
```

### Paso 2: Agregar el código del Observer
Copia la estructura de `UserObserver.php` o `ActivitiesObserver.php` hacia el nuevo archivo.

### Paso 3: Registrar en AppServiceProvider
Agrega en `app/Providers/AppServiceProvider.php`:

```php
use App\Models\Payments;
use App\Observers\PaymentsObserver;

// En el método boot():
Payments::observe(PaymentsObserver::class);
```

## 📝 Personalización

### Cambiar Qué Se Notifica

En cada observer, puedes modificar qué eventos se notifican:

```php
// Solo notificar si ciertos campos cambian
public function updated(User $user): void
{
    $isDirty = $user->isDirty(['name', 'email']);
    if ($isDirty) {
        $this->telegramService->notifyUpdate($user, 'Usuario');
    }
}
```

### Cambiar el Nombre del Modelo en Mensajes

Cambia el segundo parámetro en las notificaciones:
```php
$this->telegramService->notifyCreation($user, 'Usuario'); // Nombre personalizado
```

### Agregar Información Personalizada

Modifica el `TelegramService` para incluir más datos:

```php
public function notifyCreation($record, $modelName = 'Registro')
{
    $message = "✅ <b>Nuevo {$modelName}</b>\n\n";
    $message .= "📌 <b>ID:</b> {$record->id}\n";
    // Agrega más campos aquí
    $message .= "📧 <b>Email:</b> {$record->email}\n";
    
    return $this->sendMessage($this->chatId, $message);
}
```

## 🔍 Debugging

Los logs de todas las operaciones se guardan en:
```
storage/logs/laravel.log
```

Para ver errores de Telegram:
```bash
tail -f storage/logs/laravel.log | grep -i telegram
```

## 💡 Tips Útiles

1. **Exluir campos de actualización**: Algunos campos como `remember_token` no necesitan notificación
2. **Rate Limiting**: Si envías muchos mensajes, Telegram puede limitar, agrega pausas con `sleep()`
3. **Testing**: Puedes probar con Artisan Tinker:

```bash
php artisan tinker

$user = new App\Models\User(['name' => 'Test', 'email' => 'test@example.com']);
$user->save(); // Esto enviará una notificación
```

## ⚠️ Solución de Problemas

### ❌ "TELEGRAM_CHAT_ID no está configurado"
1. Abre tu archivo `.env`
2. Agrega `TELEGRAM_CHAT_ID=tu_numero`
3. Ejecuta `php artisan config:cache`

### ❌ "Telegram Bot no está inicializado"
1. Verifica que `TELEGRAM_BOT_TOKEN` esté en `.env` (completo, con el `:`)
2. Revisa `storage/logs/laravel.log`

### ❌ No llegan mensajes
1. Ejecuta `php artisan telegram:test` para validar configuración
2. Verifica `TELEGRAM_BOT_TOKEN` sea correcto
3. Verifica `TELEGRAM_CHAT_ID` sea correcto
4. Revisa `storage/logs/laravel.log` para errores

### ❌ Bot no responde
1. Reinicia Laravel: Ejecuta en terminal `php artisan serve`
2. Limpia caché: `php artisan config:clear`

## 📚 Resumen de cambios recientes (v2.0)

✨ **Mejoras implementadas:**
- Validación automática de configuración
- Método `getConfigurationStatus()` para diagnosticar problemas
- Mejora en manejo de errores en todas las notificaciones
- Comando `telegram:test` con validación integrada
- Información adicional en notificaciones (Modelo/Tabla)
- Mensajes de error más descriptivos
- Guía completa de configuración en `TELEGRAM_SETUP_GUIA.md`

## 📞 Más Información

- [Guía Completa de Configuración](./TELEGRAM_SETUP_GUIA.md) - Paso a paso para configurar
- [Documentación de Telegram Bot SDK](https://github.com/irazasyed/telegram-bot-sdk)
- [Referencia de API de Telegram](https://core.telegram.org/bots/api)
- [Codigo del TelegramService](./app/Services/TelegramService.php)

---

**¡Sistema listo para usar!** 🎉

Para comenzar, sigue la guía en `TELEGRAM_SETUP_GUIA.md`
