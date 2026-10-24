#!/usr/bin/env bash
set -euo pipefail

cd /app

echo "==> Startup checks"
if [ -z "${APP_KEY:-}" ]; then
  echo "ERROR: APP_KEY is missing. Set it in Render Environment (php artisan key:generate --show)."
  exit 1
fi

# Render Postgres uses DATABASE_URL; Laravel 12 expects DB_URL
if [ -n "${DATABASE_URL:-}" ] && [ -z "${DB_URL:-}" ]; then
  export DB_URL="$DATABASE_URL"
  echo "==> Mapped DATABASE_URL -> DB_URL"
fi

if [ -z "${DB_URL:-}" ] && { [ -z "${DB_HOST:-}" ] || [ "${DB_HOST}" = "127.0.0.1" ] || [ "${DB_HOST}" = "localhost" ]; }; then
  echo "ERROR: No remote database configured."
  echo "Create Render Postgres, then set:"
  echo "  DB_CONNECTION=pgsql"
  echo "  DB_URL=<Internal Database URL from Postgres>"
  echo "Do NOT set DB_HOST=127.0.0.1 on Render."
  exit 1
fi

# Prefer URL connection over leftover localhost defaults
if [ -n "${DB_URL:-}" ]; then
  unset DB_HOST DB_PORT DB_DATABASE DB_USERNAME DB_PASSWORD || true
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
