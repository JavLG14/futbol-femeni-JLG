# ⚽ Guia de Futbol Femení (Laravel)

Miniaplicació MVC feta amb **Laravel**, **Blade**, **Vite** i **Sessions**.  
Permet gestionar **Equips**, **Estadis**, **Jugadores** i **Partits** sense base de dades (les dades s’emmagatzemen en sessió).

---

## 🛠 Requisits previs

- PHP >= 8.1  
- Composer  
- Node.js i npm  
- Laravel instal·lat (per exemple, amb `laravel new` o clonant aquest projecte)

---

## 🚀 Instal·lació i arrencada del projecte


##### 1. Clonar el repositori
```bash
git clone https://github.com/JavLG14/futbol-femeni-JLG
cd futbol-femeni-JLG
```
##### 2. Instal·lar dependències PHP
```bash
composer install
```
##### 3. Instal·lar dependències front-end
```bash
npm install && npm run dev
```
##### 4. Crear el fitxer .env
```bash
cp .env.example .env
```
##### 5. Generar la clau d'aplicació
```bash
php artisan key:generate
```
##### 6. Arrencar el servidor local
```bash
php artisan serve
```

---

## 🧩 Funcionalitats

- **Equips:** llistat, detall i alta d’equips.  
- **Estadis:** llistat i alta d’estadis.  
- **Jugadores:** llistat i alta de jugadores.  
- **Partits:** llistat i alta de partits.  
- Validació de formularis i dades en sessió (`SESSION_DRIVER=file`).

---

## 👩‍💻 Autor

Projecte desenvolupat per **Javier Llorens** per a l’exercici *“Futbol Femení I”*.