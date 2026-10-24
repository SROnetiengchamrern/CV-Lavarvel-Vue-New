#!/usr/bin/env bash
set -e

cd /app

echo "Running composer..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Linking storage..."
php artisan storage:link || true

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

if [ "${RUN_SEEDERS:-false}" = "true" ]; then
  echo "Seeding database..."
  php artisan db:seed --force
fi

exec frankenphp run --config /etc/caddy/Caddyfile
