#!/usr/bin/env bash
set -euo pipefail

cd /app

echo "==> Startup checks"
if [ -z "${APP_KEY:-}" ]; then
  echo "ERROR: APP_KEY is missing. Set it in Render Environment (php artisan key:generate --show)."
  exit 1
fi

if [ -z "${DATABASE_URL:-}" ] && [ -z "${DB_HOST:-}" ]; then
  echo "ERROR: DATABASE_URL (or DB_HOST) is missing. Link your Render Postgres and set DB_CONNECTION=pgsql."
  exit 1
fi

# Render free services expect the process to listen on $PORT
export PORT="${PORT:-80}"
echo "==> Listening on port ${PORT}"

echo "==> Discover packages"
php artisan package:discover --ansi || true

echo "==> Link storage"
php artisan storage:link || true

echo "==> Cache config/routes/views"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Migrate database"
php artisan migrate --force

if [ "${RUN_SEEDERS:-false}" = "true" ]; then
  echo "==> Seed database"
  php artisan db:seed --force
fi

echo "==> Starting FrankenPHP"
exec frankenphp run --config /etc/caddy/Caddyfile
