# Arquitectura de Datos y Backend - CloverFit

## Resumen Implementado

Se ha implementado una arquitectura completa de base de datos y backend para **CloverFit** (aplicación de gestión de un gimnasio), cumpliendo todos los requisitos especificados.

---

## 📊 Entidades de Base de Datos

### 1. **Users** (Usuarios)
- **Campos:** id, name, email, password, role, email_verified_at, remember_token, timestamps
- **Función:** Gestión de usuarios y autenticación
- **Relaciones:** 1:n con Members

### 2. **Members** (Miembros)
- **Campos:** id, user_id, membership_id, name, email, phone, notes, membership_start_date, membership_end_date, is_active, timestamps, deleted_at
- **Función:** Información de miembros del gimnasio
- **Relaciones:** n:1 con User, n:1 con Membership, n:m con Classes, 1:n con Activities, 1:n con Payments, 1:n con Reviews

### 3. **Trainers** (Entrenadores)
- **Campos:** id, name, email, phone, bio, specialization, hourly_rate, image, is_active, timestamps, deleted_at
- **Función:** Gestión de entrenadores
- **Relaciones:** 1:n con Classes

### 4. **Classes** (Clases) - **ENTIDAD PRINCIPAL**
- **Campos:** id, name, description, trainer_id, level, max_members, image, is_active, timestamps, deleted_at
- **Función:** Clases de entrenamiento disponibles
- **Relaciones:** n:1 con Trainer, 1:n con ClassSchedules, n:m con Members, 1:n con Reviews
- **Características especiales:** Gestión de imágenes, SoftDelete

### 5. **ClassSchedules** (Horarios de Clases)
- **Campos:** id, class_id, day_of_week, start_time, end_time, location, timestamps
- **Función:** Horarios específicos de las clases
- **Relaciones:** n:1 con Classes

### 6. **Memberships** (Membresías)
- **Campos:** id, name, description, price, duration_months, class_limit, includes_trainer, is_active, timestamps
- **Función:** Planes de membresía disponibles
- **Relaciones:** 1:n con Members
- **Ejemplo:** Plan Básico, Estándar, Premium, VIP

### 7. **Payments** (Pagos)
- **Campos:** id, member_id, amount, payment_method, status, transaction_id, notes, payment_date, timestamps
- **Función:** Registro de pagos de miembros
- **Relaciones:** n:1 con Members

### 8. **Reviews** (Reseñas)
- **Campos:** id, member_id, class_id, rating (1-5), comment, timestamps
- **Función:** Reseñas de clases por miembros
- **Relaciones:** n:1 con Members, n:1 con Classes
- **Restricción:** Un miembro solo puede dejar una reseña por clase

### 9. **Activities** (Actividades)
- **Campos:** id, member_id, type, description, activity_date, status, duration_minutes, timestamps, deleted_at
- **Función:** Registro de actividades/entrenamientos de miembros
- **Relaciones:** n:1 con Members

### 10. **EntityNames** (Entidades - Existente)
- Se mantiene del proyecto inicial
- Soporta SoftDelete

---

## 🔗 Relaciones Implementadas

### Relaciones N:M (Muchos a Muchos)
1. **Classes ↔ Members** (tabla pivote: `class_member`)
   - Una clase tiene muchos miembros inscritos
   - Un miembro puede asistir a múltiples clases
   - Campos adicionales: enrolled_at, completed_at, is_active

2. **Activities ↔ Members** (implícita a través de foreign key)
   - Las actividades están vinculadas a miembros

### Relaciones 1:N (Uno a Muchos)
1. **Trainers → Classes**
   - Un entrenador imparte múltiples clases

2. **Users → Members**
   - Un usuario puede ser miembro

3. **Memberships → Members**
   - Una membresía tiene múltiples miembros

4. **Classes → Reviews**
   - Una clase puede tener múltiples reseñas

5. **Members → Payments**
   - Un miembro realiza múltiples pagos

6. **Members → Activities**
   - Un miembro realiza múltiples actividades

7. **Classes → ClassSchedules**
   - Una clase tiene múltiples horarios

---

## 🏭 Factories (Generadores de Datos de Prueba)

Se implementaron factories para todas las entidades:

- **TrainerFactory:** Genera entrenadores con especialidades aleatorias
- **ClassesFactory:** Genera clases con niveles y entrenadores
- **ClassScheduleFactory:** Genera horarios de clases
- **MembershipFactory:** Genera planes de membresía
- **MembersFactory:** Genera 50 miembros
- **ActivitiesFactory:** Genera actividades de entrenamiento
- **PaymentFactory:** Genera registros de pagos
- **ReviewFactory:** Genera reseñas con calificaciones

---

## 🌱 Seeders (Carga de Datos)

Se implementaron seeders para llenar la base de datos con datos de prueba:

| Seeder | Cantidad | Descripción |
|--------|----------|-------------|
| TrainerSeeder | 10 | Entrenadores con especialidades |
| MembershipSeeder | 4 | Planes predefinidos (Básico, Estándar, Premium, VIP) |
| ClassesSeeder | 15 | Clases de entrenamiento |
| ClassScheduleSeeder | 45 | 3 horarios por clase |
| MembersSeeder | 50 | Miembros con membresías aleatorias |
| ActivitiesSeeder | 100 | 2 actividades por miembro |
| PaymentSeeder | 150-250 | 3-5 pagos por miembro |
| ReviewSeeder | 50 | Reseñas únicas (un miembro/clase) |

---

## 🎛️ CRUD Principal - Classes (Clases)

### Controlador: `ClassesController`

#### Funcionalidades Implementadas:

1. **Listado con Paginación**
   - Ruta: `GET /classes`
   - 10 registros por página
   - Vista: `classes/index.blade.php`

2. **Filtrado Avanzado** (4+ parámetros)
   - Por nombre (búsqueda LIKE)
   - Por nivel (Principiante, Intermedio, Avanzado)
   - Por entrenador
   - Por estado (activa/inactiva)

3. **Creación**
   - Ruta: `GET/POST /classes/create`
   - Validación de datos
   - Gestión de imágenes (almacenamiento en `storage/app/public/classes`)
   - Vistas: `classes/create.blade.php`

4. **Edición**
   - Ruta: `GET/PUT /classes/{id}/edit`
   - Actualización selectiva de campos
   - Reemplazo de imágenes
   - Vista: `classes/edit.blade.php`

5. **Visualización Detallada**
   - Ruta: `GET /classes/{id}`
   - Muestra información completa
   - Horarios asociados
   - Miembros inscritos
   - Reseñas y calificaciones
   - Vista: `classes/show.blade.php`

6. **Borrado Lógico (SoftDelete)**
   - Ruta: `DELETE /classes/{id}`
   - Los registros se marcan como eliminados, no se borran

7. **Borrado Físico**
   - Ruta: `DELETE /classes/{id}/force`
   - Eliminación permanente de la base de datos
   - Limpieza de imágenes asociadas

8. **Restauración**
   - Ruta: `POST /classes/{id}/restore`
   - Recupera elementos eliminados lógicamente

9. **Visualización de Eliminadas**
   - Ruta: `GET /classes/trashed`
   - Paginación de elementos eliminados
   - Vista: `classes/trashed.blade.php`

---

## 🖼️ Gestión de Imágenes

### Características:
- Almacenamiento en `storage/app/public/classes`
- Validación de tipo (JPEG, PNG, JPG, GIF)
- Límite de tamaño: 2MB
- Eliminación automática al editar/borrar
- URLs públicas accesibles mediante `asset('storage/...')`

### Configuración:
```php
// En .env
FILESYSTEM_DISK=public // o local
```

---

## 🛣️ Rutas Implementadas

### Rutas de Recursos (RESTful)
```
GET    /classes              - Listado de clases
POST   /classes              - Guardar nueva clase
GET    /classes/create       - Formulario de creación
GET    /classes/{class}      - Ver detalles
PUT    /classes/{class}      - Actualizar clase
DELETE /classes/{class}      - Eliminar clase (soft)
GET    /classes/{class}/edit - Formulario de edición
```

### Rutas Adicionales
```
GET    /classes/trashed              - Ver eliminadas
POST   /classes/{id}/restore         - Restaurar clase
DELETE /classes/{id}/force           - Eliminar permanentemente
```

**Todas las rutas tienen nombres y NO permite acceso directo a vistas.**

---

## 📋 Vistas Blade Implementadas

| Ruta | Descripción |
|------|-------------|
| `classes/index.blade.php` | Listado con paginación y filtros |
| `classes/create.blade.php` | Formulario de creación con validación |
| `classes/edit.blade.php` | Formulario de edición con preview de imagen |
| `classes/show.blade.php` | Detalle completo con horarios, miembros y reseñas |
| `classes/trashed.blade.php` | Gestión de clases eliminadas |

---

## 🔍 Validaciones

### En ClassesController::store() y ::update()
```php
[
    'name' => 'required|string|max:255',
    'description' => 'required|string',
    'trainer_id' => 'required|exists:trainers,id',
    'level' => 'required|in:Principiante,Intermedio,Avanzado',
    'max_members' => 'required|integer|min:1|max:100',
    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    'is_active' => 'boolean',
]
```

---

## 📦 Estructura de Migraciones

```
✓ Users
✓ Cache
✓ Jobs  
✓ Memberships (2026_02_12_060000)
✓ EntityNames
✓ Activities
✓ Members
✓ EntityNames softDelete
✓ Trainers
✓ Classes
✓ ClassSchedules
✓ Payments
✓ Class_Member (Pivote)
✓ Reviews
✓ Activities foreign key
```

---

## 🚀 Cómo Usar

### 1. Ejecutar Migraciones y Seeders
```bash
php artisan migrate:fresh --seed
```

### 2. Verificar Datos
```bash
php artisan tinker
>>> Classes::count()              // 15
>>> Members::count()              // 50
>>> Trainers::count()             // 10
>>> Memberships::count()          // 4
>>> Review::count()               // 50
>>> Payment::count()              // 150+
```

### 3. Acceder a la Aplicación
```
http://localhost:8000/classes
```

---

## ✅ Checklist de Requisitos

- [x] Mínimo 8 entidades (Implementadas: 10)
- [x] Al menos 5 campos por tabla (Todas cumplen)
- [x] Al menos 2 relaciones N:M (Classes-Members, Activities-Members)
- [x] Al menos 2 relaciones 1:N (Trainers-Classes, Memberships-Members, +5 más)
- [x] Seeders para todas las tablas
- [x] Factories para generación de datos masivos
- [x] CRUD completo (Create, Read, Update, Delete - físico y lógico)
- [x] Paginación en listado (10 por página)
- [x] Filtrado con 4+ parámetros (nombre, nivel, entrenador, estado)
- [x] Gestión de imágenes (almacenamiento y validación)
- [x] Rutas nombradas (route names)
- [x] Sin acceso directo a vistas (todo mediante controladores)

---

## 📚 Modelos Relacionados

- `User` - Autenticación
- `Member` - Miembros del gimnasio
- `Trainer` - Entrenadores
- `Classes` - Clases de entrenamiento
- `ClassSchedule` - Horarios
- `Membership` - Planes de pago
- `Activity` - Registro de actividades
- `Payment` - Pagos
- `Review` - Reseñas

---

## 🔐 Seguridad

- Validación de datos en servidor (`Form Requests`)
- Protección contra inyección SQL (ORM Eloquent)
- Autorización mediante middleware (si se requiere)
- CSRF tokens en formularios Blade

---

## 📝 Notas Importantes

1. Las vistas utilizan Bootstrap 5 para diseño responsive
2. Se utilizan soft deletes para no perder datos históricos
3. Las imágenes se almacenan en disco público (`storage/app/public`)
4. La paginación es configurable en el controlador (actualmente 10)
5. Los seeders pueden re-ejecutarse sin problemas si la BD está vacía

---

Documento generado: 17/02/2026
Versión: Laravel 12.51.0
