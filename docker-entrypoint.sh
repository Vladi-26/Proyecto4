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
echo "MAIL_MAILER=${MAIL_MAILER}" >> /var/www/html/.env
echo "MAIL_HOST=${MAIL_HOST}" >> /var/www/html/.env
echo "MAIL_PORT=${MAIL_PORT}" >> /var/www/html/.env
echo "MAIL_USERNAME=${MAIL_USERNAME}" >> /var/www/html/.env
echo "MAIL_PASSWORD=${MAIL_PASSWORD}" >> /var/www/html/.env
echo "MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS}" >> /var/www/html/.env
echo "MAIL_FROM_NAME=${MAIL_FROM_NAME}" >> /var/www/html/.env
echo "MAIL_ENCRYPTION=${MAIL_ENCRYPTION}" >> /var/www/html/.env

# Crear base de datos SQLite con permisos correctos
touch /var/www/html/database/database.sqlite
chmod 777 /var/www/html/database/database.sqlite
chmod 777 /var/www/html/database

# Permisos de escritura en storage
chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

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
