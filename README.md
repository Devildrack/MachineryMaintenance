# MachineryMaintenance

## 🚀 Instrucciones para levantar el proyecto en local

### 📦 Requisitos previos

Asegúrate de tener instalado:

- PHP >= 8.1
- Composer
- Laravel >= 10.x
- Node.js y NPM
- MySQL o cualquier otra base de datos compatible

### 📥 1. Clonar el repositorio
Abrir terminal de git para clonar el repositorio

git clone https://github.com/Devildrack/MachineryMaintenance.git
cd MachineryMaintenance

### 2. Instalar dependencias de PHP (Laravel)
Abrir la consola en visual studio code, dentro del proyecto y escribir el siguiente comando
composer install

### 📂 3. Instalar dependencias de Node (para assets)
dentro del proyecto escribir el siguiente comando
npm install

### 🔑 4. Copiar archivo de entorno y generar clave de app
dentro del proyecto escribir el siguiente comando
cp .env.example .env
php artisan key:generate

### ⚙️ 5. Configurar variables de entorno
Edita el archivo .env y agrega tus credenciales de base de datos:

DB_DATABASE=tu_basededatos
DB_USERNAME=root
DB_PASSWORD=

### 🧱 6. Ejecutar migraciones y seeders (si aplica)
bash
Copiar
Editar
php artisan migrate --seed
💡 Si no tienes seeders, puedes omitir el --seed.

### 🧪 7. Compilar assets
npm run build

### ▶️ 8. Levantar el servidor local
php artisan serve
