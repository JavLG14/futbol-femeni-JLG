# ⚽ Futbol Femení — Proyecto (Laravel)

## 📖 Descripción del Proyecto

Proyecto desarrollado en Laravel para la gestión completa de una liga de fútbol femenino. La aplicación permite administrar:

- **Equipos y Estadios**: Gestión de clubes y sus sedes.
- **Jugadoras**: Registro y gestión de plantillas.
- **Partidos**: Calendario de enfrentamientos, asignación de árbitros y registro de resultados.
- **Usuarios**: Sistema de roles (Administrador, Manager, Árbitro) con permisos específicos.

## 🚀 Instalación y Base de Datos

Para inicializar la base de datos y cargar los datos de prueba (incluyendo usuarios, equipos y calendario de partidos), ejecuta el siguiente comando:

```bash
php artisan migrate:fresh --seed
```

> **Nota**: Este comando borrará cualquier dato existente en la base de datos y la volverá a crear desde cero.

### Herramientas de Desarrollo

Si estás utilizando el entorno Docker (Sail), tienes acceso a las siguientes herramientas:

- **Base de Datos (phpMyAdmin/Adminer)**: [http://localhost:8081](http://localhost:8081)
- **Buzón de Correos (Mailpit)**: [http://localhost:8025](http://localhost:8025)  
  _Aquí puedes ver los correos enviados por la aplicación, como las notificaciones de asignación de partidos a los árbitros._

## 🔑 Credenciales de Acceso (Seeders)

Al ejecutar los seeders, se crean los siguientes usuarios por defecto para pruebas (Password para todos: `password`):

| Rol               | Email                 | Descripción                                                        |
| :---------------- | :-------------------- | :----------------------------------------------------------------- |
| **Administrador** | `admin@example.com`   | Acceso total a todas las secciones.                                |
| **Árbitro**       | `arbitre@example.com` | Puede editar resultados de sus partidos y recibir notificaciones.  |
| **Manager**       | `[id]@manager.com`    | Por ejemplo: `1@manager.com`. Gestiona solo su equipo y jugadoras. |

## 🏗️ Arquitectura del Código

El proyecto sigue patrones de diseño robustos para asegurar la mantenibilidad:

- **Patrón Service-Repository**: Desacopla la lógica de negocio (`Services`) del acceso a datos (`Repositories`), facilitando el testing y la escalabilidad.
- **Policies**: Gestionan la autorización, asegurando que solo usuarios con permisos específicos (como editar su propio equipo) puedan realizar acciones.
- **FormRequests**: Centralizan la validación de datos de entrada.

## ✅ Tests

El proyecto incluye una suite de tests automatizados para verificar la lógica de negocio, políticas de acceso y rutas.

Para ejecutar **todos los tests**:

```bash
php artisan test
```

### Tests Disponibles

La suite cubre las siguientes áreas:

- **Unitarios (`tests/Unit`)**:
    - `EstadiServiceTest`, `JugadoraServiceTest`, `PartitServiceTest`: Verifican las operaciones CRUD.
    - `PolicyTest`: Verifica los permisos de acceso según el rol (Admin, Manager, Árbitro).
    - `RequestTest`: Verifica las reglas de validación de los formularios.
- **Feature (`tests/Feature`)**:
    - `RoutesTest`: Verifica que las rutas públicas son accesibles y las protegidas requieren autenticación/permisos.

## 🛠️ Comandos de Aplicación

La aplicación incluye comandos Artisan personalizados para el envío de notificaciones:

### 1. Enviar Jornada a Managers

Envía un resumen de la próxima jornada a todos los usuarios con rol de Manager.

```bash
php artisan jornada:enviar
```

### 2. Enviar Calendario a Árbitros

Envía a cada árbitro un listado con todos los partidos que tiene asignados (pendientes y futuros).

```bash
php artisan jornada:enviar-arbitres
```

---

## 6a.- Desarrollo de APIs REST con Laravel

Se ha implementado una API REST completa para la gestión de la aplicación, utilizando recursos API (`JsonResource`, `ResourceCollection`) y políticas de acceso.

### Endpoints Principales

Tots els endpoints de recursos (`/api/*`) retornen respostes JSON estandarditzades.

#### 1. Jugadores (`/api/jugadores`)

- **GET /**: Llistat paginat de jugadores (Públic).
- **GET /{jugadora}**: Detall d'una jugadora (Públic).
- **POST /**: Crear jugadora (Només Administradors).
- **PUT/DELETE /{jugadora}**: Editar/Eliminar (Administradors o el Manager del seu equip).

#### 2. Partits (`/api/partits`)

- **GET /**: Listado paginado de partidos (Jornada, Data, Equips, Estadi, Àrbitre).
- **GET /{partit}**: Detalle del partido.
- **POST /**: Crear partido (Solo Administradores).
- **PUT /{partit}**: Actualizar resultado (Solo Administradores o el Árbitro asignado).
- **DELETE /{partit}**: Eliminar partido (Solo Administradores).

#### 3. Estadis (`/api/estadis`)

- **GET /**: Listado paginado de estadios.
- **GET /{estadi}**: Detalle del estadio.
- **POST/PUT/DELETE**: Gestión completa (Exclusivo Administradores).

#### 4. Equips (`/api/equips`)

- **GET /**: Listado paginado de equipos.
- **GET /{equip}**: Detalle del equipo incluyendo URL del escudo.
- **POST /**: Crear equipo (Solo Administradores).
- **PUT/DELETE /{equip}**: Editar/Eliminar (Administradores o el Manager del equipo).

#### 5. Autenticación y Perfil

- **POST /api/login**: Obtener token de acceso (Sanctum).
- **POST /api/register**: Registro de nuevos usuarios.
- **POST /api/logout**: Revocar token.
- **GET /api/profile**: Devuelve los datos del usuario autenticado, su rol y una lista de permisos.

---

## 📋 Parámetros de API (Referencia Rápida)

Listado detallado de los parámetros necesarios para las peticiones POST y PUT, organizado por recurso.

### 1. Autenticación (`/api/`)

| Endpoint     | Método           | Parámetros Requeridos                                                                                      |
| :----------- | :--------------- | :--------------------------------------------------------------------------------------------------------- |
| **Login**    | `POST /login`    | - `email` (email)<br>- `password` (string)                                                                 |
| **Registro** | `POST /register` | - `name` (string)<br>- `email` (email)<br>- `password` (string)<br>- `confirm_password` (same as password) |
| **Logout**   | `POST /logout`   | _(Requiere token Bearer en cabecera)_                                                                      |

### 2. Equipos (`/api/equips`)

**POST (Crear) - `/api/equips`**

- `nom`: (Requerido) Mínimo 3 caracteres.
- `estadi_id`: (Requerido) ID válido de un estadio existente.
- `titols`: (Requerido) Número entero, mínimo 0.
- `escut`: (Opcional) Imagen (jpeg, png, jpg), máx 2MB.

**PUT (Actualizar) - `/api/equips/{id}`**

- `nom`: (Opcional si no cambia) Único en la tabla equipos.
- `estadi_id`: (Opcional) ID válido de estadio.
- `titols`: (Opcional) Entero, mínimo 0.
- `escut`: (Opcional) Imagen.
    > **Nota:** Para actualizar ficheros (escut) mediante PUT, a veces es necesario enviar como `POST` añadiendo el campo `_method` = `PUT` en el body si tienes problemas con `multipart/form-data`.

### 3. Estadios (`/api/estadis`)

**POST / PUT - `/api/estadis`** (Mismos parámetros para crear y actualizar)

- `nom`: (Requerido) Texto entre 3 y 255 caracteres.
- `capacitat`: (Requerido) Número entero, mínimo 0.

### 4. Jugadoras (`/api/jugadores`)

**POST / PUT - `/api/jugadores`**

- `nom`: (Requerido) Texto, máx 255 caracteres.
- `dorsal`: (Requerido) Número entero, mínimo 0.
- `equip_id`: (Requerido) ID válido de un equipo existente.
- `data_naixement`: (Requerido) Fecha (YYYY-MM-DD), debe tener al menos 16 años.
- `foto`: (Opcional) Archivo de imagen (solo **png**), máx 2MB.

### 5. Partidos (`/api/partits`)

**POST / PUT - `/api/partits`**

- `local_id`: (Requerido) ID equipo local (diferente al visitante).
- `visitant_id`: (Requerido) ID equipo visitante (diferente al local).
- `estadi_id`: (Requerido) ID válido de un estadio.
- `data`: (Requerido) Fecha válida.
- `jornada`: (Requerido) Número entero, mínimo 1.
- `gols_local`: (Opcional) Entero, mínimo 0.
- `gols_visitant`: (Opcional) Entero, mínimo 0.

---

**Autor:** Javier Llorens Gosalbez
