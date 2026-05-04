#!/bin/bash
set -e

# Install composer dependencies if vendor is missing
if [ ! -d "vendor" ]; then
    echo "Installing composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Create .env from example if missing
if [ ! -f ".env" ]; then
    echo "Creating .env from .env.example..."
    cp .env.example .env
    php artisan key:generate --ansi
fi

# Fix storage permissions
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Wait for MySQL to be fully ready (not just TCP-alive, but accepting queries)
echo "Waiting for MySQL..."
until php artisan db:show > /dev/null 2>&1; do
    printf "."
    sleep 2
done
echo " MySQL ready!"

# Run migrations
echo "Running migrations..."
php artisan migrate --force

exec "$@"
