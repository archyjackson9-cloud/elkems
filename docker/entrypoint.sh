#!/bin/sh
set -e
cd /var/www/html

# storage is a mounted volume: make sure the structure exists
mkdir -p storage/app/public storage/framework/cache/data storage/framework/sessions \
         storage/framework/views storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

if [ "$1" = "supervisord" ]; then
    # Wait for the database
    if [ -n "$DB_HOST" ]; then
        echo "Waiting for database at $DB_HOST:${DB_PORT:-3306}..."
        i=0
        until php -r 'try { new PDO("mysql:host=" . getenv("DB_HOST") . ";port=" . (getenv("DB_PORT") ?: 3306), getenv("DB_USERNAME"), getenv("DB_PASSWORD")); } catch (Exception $e) { exit(1); }' 2>/dev/null; do
            i=$((i+1))
            if [ "$i" -ge 60 ]; then echo "Database not reachable"; exit 1; fi
            sleep 2
        done
    fi

    su-exec www-data php artisan storage:link --force || true
    if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
        su-exec www-data php artisan migrate --force
    fi
    su-exec www-data php artisan config:cache
    su-exec www-data php artisan route:cache
    su-exec www-data php artisan view:cache
fi

exec "$@"
