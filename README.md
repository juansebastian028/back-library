## Pasos para iniciar el proyecto

- Ejecutar composer install
- Ejecutar composer require laravel/passport (Necesario para la auteticacion)
- Ejecutar php artisan migrate:refresh --seed (Crea las tablas y crea los campos de roles automaticamente)
- Ejecutar php artisan passport:install --force (Necesario para la auteticacion)
- Ejecutar el comando cp .env-example .env
- Ejecutar el comando php artisan key:generate
