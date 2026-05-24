#!/bin/bash

# Crear .env si no existe
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Escribir variables de entorno en .env
echo "APP_NAME=${APP_NAME}" >> /var/www/html/.env
echo "APP_ENV=${APP_ENV}" >> /var/www/html/.env
echo "APP_DEBUG=${APP_DEBUG}" >> /var/www/html/.env
echo "APP_URL=${APP_URL}" >> /var/www/html/.env
echo "APP_KEY=${APP_KEY}" >> /var/www/html/.env
echo "DB_CONNECTION=${DB_CONNECTION}" >> /var/www/html/.env
echo "DB_DATABASE=${DB_DATABASE}" >> /var/www/html/.env
echo "SESSION_DRIVER=${SESSION_DRIVER}" >> /var/www/html/.env
echo "CACHE_DRIVER=${CACHE_DRIVER}" >> /var/www/html/.env
echo "QUEUE_CONNECTION=${QUEUE_CONNECTION}" >> /var/www/html/.env

# Crear base de datos SQLite si no existe
touch /var/www/html/database/database.sqlite

# Ejecutar migraciones
php artisan migrate --force

# Ejecutar seeders
php artisan db:seed --force

# Cachear configuración
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar Apache
exec "$@"
