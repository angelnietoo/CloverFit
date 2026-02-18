# 🤖 Guía Completa: Notificaciones Automáticas de Telegram - CloverFit

## ¿Qué son las notificaciones automáticas?

Tu aplicación CloverFit debe enviar **notificaciones automáticas a Telegram** cuando ocurren eventos específicos:
- ✅ Cuando se **crea** un usuario, actividad, miembro o entidad
- 🔄 Cuando se **actualiza** un registro
- 🗑️ Cuando se **elimina** un registro

---

## 📋 Estado Actual (Ya Implementado ✓)

Tu proyecto ya tiene:
- ✅ `TelegramService` - Servicio para enviar mensajes
- ✅ Observers configurados - Capturan eventos de base de datos
- ✅ Métodos de notificación listos - `notifyCreation()`, `notifyUpdate()`, `notifyDeletion()`
- ✅ Validación de configuración - Detecta si faltan variables

**Lo que falta es la configuración del `.env`**

---

## 🔧 Paso 1: Obtener el Token del Bot de Telegram

### 1.1 Crear el Bot en BotFather

1. Abre Telegram y busca **@BotFather**
2. O ve directamente: https://t.me/botfather
3. Envía el comando: `/newbot`
4. Responde las preguntas:
   - **Nombre del bot**: ej. "CloverFit Notificaciones"
   - **Username del bot**: ej. "cloverfit_notifications_bot" (debe terminar en _bot)

5. ✅ Recibirás algo como:
```
🎉 Done! Congratulations on your new bot. 
You will find it at t.me/cloverfit_notifications_bot. 
You can now add a description, about section and commands. 
By the way, when you've finished creating your cool bot, ping our bot therapist @BotFather to give your bot extra powers!

Use this token to access the HTTP API:
8436319300:AAG2nzt4acWlDS9IN3xQUChZfIFg7nTFD54

Keep your token secure and store it safely!
```

6. **Guarda este token** (la parte después de "token to access the HTTP API:")
   ```
   TELEGRAM_BOT_TOKEN=8436319300:AAG2nzt4acWlDS9IN3xQUChZfIFg7nTFD54
   ```

---

## 📱 Paso 2: Obtener tu Chat ID

### 2.1 Enviar un mensaje al bot

1. Abre tu nuevo bot en Telegram (ej: @cloverfit_notifications_bot)
2. Presiona **Iniciador** o escribe cualquier mensaje y envía
3. El bot estará vacío (aún no tiene funciones), pero eso está bien

### 2.2 Obtener el Chat ID

1. Vuelve a BotFather
2. En el menú, selecciona tu bot
3. Usa `/getme` para ver detalles del bot
4. Abre esta URL en tu navegador (reemplaza `TOKEN`):
   ```
   https://api.telegram.org/botTOKEN/getUpdates
   ```
   Ejemplo:
   ```
   https://api.telegram.org/bot8436319300:AAG2nzt4acWlDS9IN3xQUChZfIFg7nTFD54/getUpdates
   ```

5. Verás JSON similar a:
```json
{
  "ok": true,
  "result": [
    {
      "update_id": 123456789,
      "message": {
        "message_id": 1,
        "date": 1676234567,
        "chat": {
          "id": 1509752076,
          "first_name": "Tu Nombre",
          "type": "private"
        },
        "text": "Hola"
      }
    }
  ]
}
```

6. Busca `"chat":{"id":` - el número que sigue es tu **CHAT_ID**
   ```
   TELEGRAM_CHAT_ID=1509752076
   ```

---

## ⚙️ Paso 3: Configurar el Archivo `.env`

### 3.1 Editar el archivo `.env`

1. Abre la carpeta `my-app` en tu proyecto
2. Crea o edita el archivo `.env`
3. Busca las líneas (o agrégalas si no existen):
   ```env
   TELEGRAM_BOT_TOKEN=
   TELEGRAM_CHAT_ID=
   ```

4. Llena con tu información:
   ```env
   TELEGRAM_BOT_TOKEN=8436319300:AAG2nzt4acWlDS9IN3xQUChZfIFg7nTFD54
   TELEGRAM_CHAT_ID=1509752076
   ```

📌 **Importante**: 
- No pongas comillas
- No compartas el TOKEN en redes públicas o repositorios
- Asegúrate de que `.env` está en `.gitignore` (ya debería estarlo)

---

## ✅ Paso 4: Verificar que Funciona

### 4.1 Ejecutar comando de prueba

Abre una terminal en la carpeta `my-app` y ejecuta:

```bash
php artisan telegram:test
```

Deberías ver:
```
🤖 Probando Sistema de Notificaciones de Telegram...

📋 Estado de la configuración:
┌─────────────────────────┬──────────┐
│ Parámetro               │ Estado   │
├─────────────────────────┼──────────┤
│ Bot inicializado        │ ✓ Sí     │
│ Token configurado       │ ✓ Sí     │
│ Chat ID configurado     │ ✓ Configurado │
└─────────────────────────┴──────────┘

✅ ¡Éxito! El mensaje fue enviado a Telegram correctamente.

🎯 A partir de ahora:
- Cuando se cree un usuario → notificación automática ✅
- Cuando se actualice un usuario → notificación automática 🔄
- Cuando se elimine un usuario → notificación automática 🗑️
```

### 4.2 Verificar en Telegram

Revisa tu chat privado en Telegram - deberías recibir un mensaje de prueba:
```
🧪 Mensaje de Prueba - CloverFit

✅ Las notificaciones automáticas funcionan correctamente
⏰ Fecha: 2026-02-17 14:30:45
💻 Entorno: local
🌐 URL: http://localhost
```

---

## 🚀 Paso 5: Probar Notificaciones Automáticas

### 5.1 Crear un usuario (desde tu aplicación)

Tu aplicación tiene interfaces web. Cuando crees un usuario:
- Sistema crea el registro
- Observer captura el evento `created`
- TelegramService envía notificación

Todo **AUTOMÁTICO**.

Deberías recibir en Telegram:
```
✅ Nuevo Usuario Creado

📌 ID: 5
📝 Nombre: Juan Pérez
📊 Modelo: User
⏰ Fecha: 2026-02-17 14:30:45
🌐 Aplicación: CloverFit
```

### 5.2 Actualizar un usuario

Cuando cambies datos de un usuario:
```
🔄 Usuario Actualizado

📌 ID: 5
📝 Nombre: Juan García
📊 Modelo: User
⏰ Fecha: 2026-02-17 14:31:50
🌐 Aplicación: CloverFit
```

### 5.3 Eliminar un usuario

Cuando borres un usuario:
```
🗑️ Usuario Eliminado

📌 ID: 5
📝 Nombre: Juan García
📊 Modelo: User
⏰ Fecha: 2026-02-17 14:32:00
🌐 Aplicación: CloverFit
```

---

## 🔍 Solucionar Problemas

### ❌ Error: "TELEGRAM_CHAT_ID no está configurado"

**Solución:**
1. Abre tu archivo `.env`
2. Verifica que tenga `TELEGRAM_CHAT_ID=TU_NUMERO` (sin comillas)
3. Ejecuta `php artisan config:cache` para limpiar caché
4. Reinicia tu servidor

### ❌ Error: "Telegram Bot no está inicializado"

**Solución:**
1. Verifica que `TELEGRAM_BOT_TOKEN` esté en `.env`
2. Asegúrate de que el token esté completo (contiene `:`)
3. Revisa los logs: `storage/logs/laravel.log`

### ❌ Error SSL en Windows

**Solución:**
- El sistema intenta automáticamente una fallback sin verificación SSL
- Si sigue fallando, revisa `storage/logs/laravel.log`

### ❌ Los mensajes llegan pero no en mi chat

**Solución:**
1. Verifica que el `CHAT_ID` sea correcto
2. Asegúrate de haber enviado al menos un mensaje al bot en Telegram
3. Puede haber un delay de 1-2 segundos en enviar

---

## 📚 Comandos Útiles

```bash
# Probar todas las notificaciones
php artisan telegram:test

# Probar solo creación
php artisan telegram:test --type=creation

# Probar solo actualización
php artisan telegram:test --type=update

# Probar solo eliminación
php artisan telegram:test --type=deletion

# Probar error
php artisan telegram:test --type=error

# Ver logs en tiempo real (Windows PowerShell)
Get-Content storage/logs/laravel.log -Tail 20 -Wait
```

---

## 🎯 Modelos que ya tienen notificaciones automáticas

- ✅ **User** - Usuarios
- ✅ **activities** - Actividades
- ✅ **members** - Miembros  
- ✅ **EntityName** - Entidades

### Para agregar notificaciones a otro modelo:

1. Crea el Observer:
   ```bash
   php artisan make:observer PaymentsObserver --model=Payments
   ```

2. Copia el contenido de [app/Observers/UserObserver.php](../app/Observers/UserObserver.php)

3. Registra en [app/Providers/AppServiceProvider.php](../app/Providers/AppServiceProvider.php):
   ```php
   use App\Models\Payments;
   use App\Observers\PaymentsObserver;
   
   public function boot(): void
   {
       Payments::observe(PaymentsObserver::class);
   }
   ```

---

## 📖 Más Información

- [TELEGRAM_SETUP.md](./TELEGRAM_SETUP.md) - Documentación técnica
- [app/Services/TelegramService.php](../app/Services/TelegramService.php) - Código del servicio
- [app/Observers/](../app/Observers/) - Observers de eventos

---

**¿Listo?** 🚀 Sigue los pasos 1-5 y tendrás notificaciones automáticas funcionando en 10 minutos.
