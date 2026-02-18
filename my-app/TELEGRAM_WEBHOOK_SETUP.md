# 🤖 Configurar Webhook para que el Bot Responda a Mensajes

## ¿Por qué el bot no responde?

Tu bot actual **solo envía notificaciones** cuando ocurren eventos (crear/editar/eliminar registros). Pero **no recibe ni responde** a los mensajes de los usuarios.

Para que responda a mensajes, Telegram debe poder **enviar los mensajes a tu servidor**. Esto se hace a través de un **webhook**.

---

## 🔧 Configuración de 3 pasos

### Paso 1: Ejecutar las migraciones

Primero, crea la tabla para guardar los chat_ids de usuarios:

```bash
php artisan migrate
```

Esto crea la tabla `telegram_users` que almacena:
- `telegram_chat_id` - ID del chat con el usuario
- `telegram_username` - Username en Telegram
- `first_name` - Nombre del usuario
- `user_id` - Relación con tu usuario en la app (opcional)

### Paso 2: Obtener tu URL pública

Para que Telegram pueda enviar mensajes a tu servidor, necesitas:

**En desarrollo local:**
```bash
# Usa ngrok para exponer tu servidor local
# Descarga desde: https://ngrok.com/download

ngrok http 8000
```

Esto te dará una URL pública como: `https://abc123.ngrok.io`

**En producción:**
- Tu dominio: `https://tudominio.com`

### Paso 3: Registrar el webhook en Telegram

Ejecuta este comando (reemplaza `TOKEN` y `URL`):

```bash
curl -F "url=https://tudominio.com/api/telegram/webhook" https://api.telegram.org/botTOKEN/setWebhook
```

**Ejemplo completo:**
```bash
curl -F "url=https://abc123.ngrok.io/api/telegram/webhook" https://api.telegram.org/bot8436319300:AAG2nzt4acWlDS9IN3xQUChZfIFg7nTFD54/setWebhook
```

### Verificar que funciona:

```bash
# Ver el estado del webhook
curl https://api.telegram.org/bot8436319300:AAG2nzt4acWlDS9IN3xQUChZfIFg7nTFD54/getWebhookInfo
```

Deberías ver algo como:
```json
{
  "ok": true,
  "result": {
    "url": "https://abc123.ngrok.io/api/telegram/webhook",
    "has_custom_certificate": false,
    "pending_update_count": 0
  }
}
```

---

## 🎯 Cómo funciona ahora

### Flujo de un usuario escribiendo al bot:

1. **Usuario escribe al bot:** "Hola"
2. **Telegram envía a tu servidor:** POST `https://tudominio.com/api/telegram/webhook`
3. **Tu servidor procesa:** `ProcessTelegramWebhook` es ejecutado
4. **Se guarda el chat_id:** En la tabla `telegram_users`
5. **Bot responde automáticamente:**
   ```
   ¡Hola! 👋 Bienvenido a CloverFit
   
   Soy tu asistente de Telegram. Puedo ayudarte con:
   
   📋 /info - Información general
   ⏰ /horario - Horario de atención
   ❓ /ayuda - Ayuda
   📧 /contacto - Contacto directo
   ```

### Respuestas automáticas disponibles:

| Comando | Respuesta |
|---------|-----------|
| `/start`, `hola`, `hi` | Saludo y menú principal |
| `info`, `información` | Información de CloverFit |
| `horario`, `horas` | Horario de atención |
| `ayuda`, `help` | Menú de ayuda |
| Cualquier otro mensaje | Respuesta por defecto |

---

## 📚 Estructura de datos

### Tabla `telegram_users`

```
id              - ID único
user_id         - FK a tabla users (opcional)
telegram_chat_id - ID único del chat con el usuario (IMPORTANTE)
telegram_username - Username en Telegram (@usuario)
first_name      - Nombre del usuario
created_at
updated_at
```

---

## 🚀 Casos de uso avanzados

### 1. Notificar a un usuario específico

Cuando un usuario se registra, puedes guardar su chat_id:

```php
// En el modelo User
public function telegramUser()
{
    return $this->hasOne(TelegramUser::class);
}

// En un controlador
$user->telegramUser()->create([
    'telegram_chat_id' => $chatId,
    'telegram_username' => $username,
]);
```

### 2. Enviar notificaciones personalizadas

```php
$telegramUser = TelegramUser::where('user_id', $userId)->first();

if ($telegramUser) {
    $telegramService->sendMessage(
        $telegramUser->telegram_chat_id,
        "Hola {$user->name}, tu membresía fue confirmada! ✅"
    );
}
```

### 3. Enviar a múltiples usuarios

```php
$telegramUsers = TelegramUser::whereIn('user_id', $userIds)->get();

foreach ($telegramUsers as $tu) {
    $telegramService->sendMessage(
        $tu->telegram_chat_id,
        "Anuncio: Nueva clase disponible mañana a las 18:00"
    );
}
```

---

## 🔍 Debugging

### Ver logs de mensajes recibidos:

```bash
# Windows PowerShell
Get-Content storage/logs/laravel.log -Tail 50 -Wait

# Linux/Mac
tail -f storage/logs/laravel.log
```

Verás algo como:
```
[2026-02-17 15:30:45] local.INFO: Webhook de Telegram recibido 
[2026-02-17 15:30:45] local.INFO: Mensaje recibido de Telegram 
{"chat_id": 123456, "username": "usuario123", "text": "hola"}
```

### Probar el webhook manualmente:

```bash
curl -X POST https://tudominio.com/api/telegram/webhook \
  -H "Content-Type: application/json" \
  -d '{
    "update_id": 123,
    "message": {
      "message_id": 1,
      "date": 1676341445,
      "chat": {
        "id": 123456789,
        "first_name": "Juan",
        "username": "juan123",
        "type": "private"
      },
      "text": "hola"
    }
  }'
```

### Verificar health del webhook:

```bash
curl https://tudominio.com/api/telegram/health
```

Resultado:
```json
{
  "status": "ok",
  "bot_name": "CRX7Bot",
  "timestamp": "2026-02-17 15:30:45"
}
```

---

## ⚠️ Solución de problemas

### ❌ "El webhook no funciona"

1. Verifica que tu URL es accesible:
   ```bash
   curl https://tudominio.com/api/telegram/health
   ```

2. Revisa que el webhook está registrado:
   ```bash
   curl https://api.telegram.org/bot{TOKEN}/getWebhookInfo
   ```

3. Revisa los logs en `storage/logs/laravel.log`

### ❌ "ngrok: command not found"

Descarga y extrae ngrok:
- Windows: https://ngrok.com/download
- Linux: `apt install ngrok`
- Mac: `brew install ngrok`

### ❌ "CSRF token mismatch"

Ya está resuelto en las rutas (usa `withoutMiddleware`), pero si tienes algún issue, verifica que no haya middleware bloqueando.

### ❌ "El bot responde lentamente"

El procesamiento es asíncrono (background), pero si es muy lento:

1. Usa Redis para queue:
   ```env
   QUEUE_CONNECTION=redis
   ```

2. Ejecuta el worker:
   ```bash
   php artisan queue:work
   ```

---

## 📝 Checklist de configuración

- [ ] He ejecutado `php artisan migrate`
- [ ] He obtenido una URL pública (ngrok o dominio)
- [ ] He registrado el webhook con `setWebhook`
- [ ] He verificado con `getWebhookInfo`
- [ ] Escribí un mensaje al bot y recibí respuesta
- [ ] Verifiqué que los chat_ids se guardan en `telegram_users`
- [ ] Revisé los logs en `storage/logs/laravel.log`

---

## 📞 Próximas mejoras

Ahora que el bot responde:

1. ✅ Notificaciones automáticas cuando se crean registros
2. ✅ Respuestas automáticas a mensajes de usuarios
3. 🔜 Crear un panel de administración para mensajes masivos
4. 🔜 Integrar comandos adicionales (/estado_membresia, /reservar_clase, etc.)
5. 🔜 Guardar conversaciones en la BD para análisis

---

**¿Preguntas?** Revisa [TELEGRAM_SETUP_GUIA.md](./TELEGRAM_SETUP_GUIA.md) para configuración inicial.
