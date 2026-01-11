# ⚽ Futbol Femení — Proyecto (Laravel)

## 📖 Descripción del Proyecto

Proyecto desarrollado en Laravel para la gestión completa de una liga de fútbol femenino. La aplicación permite administrar:

-   **Equipos y Estadios**: Gestión de clubes y sus sedes.
-   **Jugadoras**: Registro y gestión de plantillas.
-   **Partidos**: Calendario de enfrentamientos, asignación de árbitros y registro de resultados.
-   **Usuarios**: Sistema de roles (Administrador, Manager, Árbitro) con permisos específicos.

## 🚀 Instalación y Base de Datos

Para inicializar la base de datos y cargar los datos de prueba (incluyendo usuarios, equipos y calendario de partidos), ejecuta el siguiente comando:

```bash
php artisan migrate:fresh --seed
```

> **Nota**: Este comando borrará cualquier dato existente en la base de datos y la volverá a crear desde cero.

### Herramientas de Desarrollo

Si estás utilizando el entorno Docker (Sail), tienes acceso a las siguientes herramientas:

-   **Base de Datos (phpMyAdmin/Adminer)**: [http://localhost:8081](http://localhost:8081)
-   **Buzón de Correos (Mailpit)**: [http://localhost:8025](http://localhost:8025)  
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

-   **Patrón Service-Repository**: Desacopla la lógica de negocio (`Services`) del acceso a datos (`Repositories`), facilitando el testing y la escalabilidad.
-   **Policies**: Gestionan la autorización, asegurando que solo usuarios con permisos específicos (como editar su propio equipo) puedan realizar acciones.
-   **FormRequests**: Centralizan la validación de datos de entrada.

## ✅ Tests

El proyecto incluye una suite de tests automatizados para verificar la lógica de negocio, políticas de acceso y rutas.

Para ejecutar **todos los tests**:

```bash
php artisan test
```

### Tests Disponibles

La suite cubre las siguientes áreas:

-   **Unitarios (`tests/Unit`)**:
    -   `EstadiServiceTest`, `JugadoraServiceTest`, `PartitServiceTest`: Verifican las operaciones CRUD.
    -   `PolicyTest`: Verifica los permisos de acceso según el rol (Admin, Manager, Árbitro).
    -   `RequestTest`: Verifica las reglas de validación de los formularios.
-   **Feature (`tests/Feature`)**:
    -   `RoutesTest`: Verifica que las rutas públicas son accesibles y las protegidas requieren autenticación/permisos.

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

**Autor:** Javier Llorens Gosalbez
