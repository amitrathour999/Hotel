#!/usr/bin/env bash
# exit on error
set -o errexit

composer install --no-dev --optimize-autoloader
php artisan storage:link || true
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan migrate --force
