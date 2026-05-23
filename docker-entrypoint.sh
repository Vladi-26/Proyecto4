#!/bin/bash

# Generar APP_KEY si no existe
php artisan key:generate --force

# Ejecutar migraciones
php artisan migrate --force

# Ejecutar seeders
php artisan db:seed --force

# Limpiar y cachear configuración
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar Apache
exec "$@"
