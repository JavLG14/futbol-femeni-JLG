# ⚽ Futbol Femení — Proyecto (Laravel)

Breve descripción

Proyecto MVC en Laravel para gestionar equipos, estadios, jugadoras y partidos. Implementa:

-   Migraciones y modelos con relaciones (equipos ↔ jugadoras, partidos ↔ equipos/estadios).
-   Arquitectura Service + Repository para jugadores/partits/equips.
-   Formularios validados con FormRequest (validación de fechas, ficheros, campos numéricos).
-   Factories y seeders que generan 18 equipos, jugadoras y un calendario (ida y vuelta) con resultados aleatorios cuando la fecha ya ha pasado.
-   Vistas Blade y componentes reutilizables para mostrar equip, jugadora y partit.

Este README explica cómo instalar y ejecutar la aplicación en local.

## Requisitos

-   PHP >= 8.2
-   Composer
-   Node.js y npm

## Instalación rápida

Clona el repositorio y entra en la carpeta:

```bash
git clone https://github.com/JavLG14/futbol-femeni-JLG/tree/entrega2
cd futbol-femeni-JLG
```

Instala dependencias PHP y JS:

```bash
composer install
npm install
```

Copia el fichero de entorno y genera la clave de aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

Configura la base de datos en `.env` (por defecto se usan migraciones para crear las tablas). Luego ejecuta las migraciones y los seeders opcionales:

```bash
php artisan migrate
php artisan db:seed --class=EquipsSeeder
php artisan db:seed --class=JugadoresSeeder
php artisan db:seed --class=CalendarioSeeder
```

Compila el frontend en modo desarrollo y arranca el servidor de Laravel:

```bash
npm run dev
php artisan serve
```

La app estará disponible típicamente en http://127.0.0.1:8000


## Estructura y patrón de diseño

-   Rutas: `routes/web.php`
-   Controladores: `app/Http/Controllers/`
-   Servicios: `app/Services/` (logica de negocio)
-   Repositorios: `app/Repositories/` (acceso a datos)
-   Modelos: `app/Models/`
-   Vistas: `resources/views/` (componentes en `resources/views/components`)

---

Autor: Javier Llorens
