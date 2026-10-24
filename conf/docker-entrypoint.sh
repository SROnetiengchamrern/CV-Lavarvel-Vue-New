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

# Avoid fragile DB sessions/cache on free tier (ephemeral disk is fine for a CV site)
export SESSION_DRIVER="${SESSION_DRIVER:-file}"
export CACHE_STORE="${CACHE_STORE:-file}"
export SESSION_SECURE_COOKIE="${SESSION_SECURE_COOKIE:-true}"

mkdir -p storage/framework/sessions storage/framework/cache/data storage/logs
chmod -R 775 storage bootstrap/cache || true

echo "==> Discover packages"
php artisan package:discover --ansi || true

echo "==> Link storage"
php artisan storage:link || true

echo "==> Clear stale caches then rebuild"
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Migrate database"
php artisan migrate --force

if [ "${RUN_SEEDERS:-false}" = "true" ]; then
  echo "==> Seed database"
  php artisan db:seed --force
fi

# FrankenPHP binary is blocked on some Render free hosts (exit 126 / Operation not permitted).
# PHP itself works (migrate/seed already ran), so serve with artisan.
echo "==> Starting Laravel on 0.0.0.0:${PORT}"
exec php artisan serve --host=0.0.0.0 --port="${PORT}"
