# 1) Build Vue/Vite assets
FROM node:22-alpine AS frontend

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js ./
COPY public ./public
RUN npm run build

# 2) FrankenPHP (PHP + Caddy) — no compiling gcc on Render free
FROM dunglas/frankenphp:1-php8.2

RUN install-php-extensions pdo_pgsql pdo_mysql intl zip opcache

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV SERVER_NAME=:80

WORKDIR /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY . /app
COPY --from=frontend /app/public/build /app/public/build

RUN mkdir -p storage/app/public \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chmod +x /app/scripts/*.sh \
    && sed -i 's/\r$//' /app/scripts/*.sh \
    && chown -R www-data:www-data /app/storage /app/bootstrap/cache

COPY conf/Caddyfile /etc/caddy/Caddyfile
COPY conf/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh \
    && sed -i 's/\r$//' /usr/local/bin/docker-entrypoint.sh /etc/caddy/Caddyfile

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
